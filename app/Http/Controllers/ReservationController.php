<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Reservation;
use Illuminate\Support\Facades\Auth;

use App\Notifications\ReservationStatusNotification;
use App\Notifications\NewReservationNotification;
use App\Notifications\ReservationCompletedNotification;
use App\Notifications\ReservationStatusUpdated;


class ReservationController extends Controller
{
    // Show the reservation form with booked dates
    public function showReservationPage()
    {
        $bookedDates = Reservation::where('status', 'confirmed')->pluck('reservation_date')->toArray();

        // API Response
        if (request()->is('api/*')) {
            return response()->json(['booked_dates' => $bookedDates], 200);
        }

        // Web Response
        return view('frontend.reservation', compact('bookedDates'));
    }

    // Show the list of reservations
    public function index(Request $request)
    {
        $search = $request->input('search');

        // Common query logic for both API and web
        $query = Reservation::when($search, function ($query, $search) {
            $query->where('name', 'like', "%$search%")
                ->orWhere('reservation_date', 'like', "%$search%")
                ->orWhere('reservation_time', 'like', "%$search%")
                ->orWhere('number_of_guests', 'like', "%$search%");
        })->orderBy('id', 'DESC');

        // API Response
        if ($request->is('api/*')) {
            // Simple response for API with only relevant data
            $reservations = $query->paginate(10)->toArray(); // Includes pagination metadata
            return response()->json([
                'status' => 'success',
                'reservations' => $reservations['data'], // Only the data portion of the paginated results
                'pagination' => [
                    'current_page' => $reservations['current_page'],
                    'last_page' => $reservations['last_page'],
                    'total' => $reservations['total'],
                ],
            ], 200);
        }

        // Web Response
        $reservations = $query->paginate(10); // For Blade views, retain the full paginator object
        return view('dashboard.reservations.index', compact('reservations'));
    }


    // Store reservation
    public function store(Request $request)
    {
        // Ensure the user is authenticated
        if (!Auth::check()) {
            if ($request->is('api/*')) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Authentication required to make a reservation.',
                ], 401);
            }
            return redirect()->route('login-signup.form')->withErrors('You need to log in to make a reservation.');
        }

        // Validate the reservation data
        $validated = $request->validate([
            'phone_number' => 'required|string|max:15',
            'reservation_date' => 'required|date',
            'reservation_time' => 'required|date_format:H:i',
            'number_of_guests' => 'required|integer|min:1',
            'note' => 'nullable|string',
            'status' => 'nullable|string|in:pending,confirmed,cancelled',
        ]);

        // Validate store hours
        $dayOfWeek = date('w', strtotime($validated['reservation_date'])); // 0 = Sunday, ..., 6 = Saturday
        $storeHours = [
            0 => ['open' => '13:00', 'close' => '20:00'], // Sunday
            1 => ['open' => '12:00', 'close' => '21:00'], // Monday
            2 => ['open' => '12:00', 'close' => '21:00'], // Tuesday
            3 => ['open' => '12:00', 'close' => '21:00'], // Wednesday
            4 => ['open' => '12:00', 'close' => '21:00'], // Thursday
            5 => ['open' => '12:00', 'close' => '21:00'], // Friday
            6 => ['open' => '12:00', 'close' => '21:00'], // Saturday
        ];

        $storeOpen = $storeHours[$dayOfWeek]['open'];
        $storeClose = $storeHours[$dayOfWeek]['close'];

        if ($validated['reservation_time'] < $storeOpen || $validated['reservation_time'] > $storeClose) {
            if ($request->is('api/*')) {
                return response()->json([
                    'status' => 'error',
                    'message' => "Reservation time must be between $storeOpen and $storeClose.",
                ], 422);
            }
            return back()->withErrors("Reservation time must be between $storeOpen and $storeClose.");
        }

        // Check if a reservation with the same date and time already exists
        $existingReservation = Reservation::where('reservation_date', $validated['reservation_date'])
            ->where('reservation_time', $validated['reservation_time'])
            ->where('status', 'confirmed') // Ensure that only confirmed reservations are considered
            ->exists();

        if ($existingReservation) {
            if ($request->is('api/*')) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'This slot is already booked.',
                ], 422);
            }
            return back()->withErrors('This slot is already booked.');
        }

        // Use authenticated user's name and email
        $validated['name'] = Auth::user()->firstname;
        $validated['email'] = Auth::user()->email;

        // Create the reservation
        $reservation = Reservation::create(array_merge($validated, [
            'status' => $request->input('status', 'pending'),
        ]));

        // Notify admins for frontend reservations
        if ($request->route()->getName() === 'reservation.store') {
            $admins = \App\Models\User::where('role', 'admin')->get();
            foreach ($admins as $admin) {
                $admin->notify(new NewReservationNotification($reservation));
            }

            if ($request->is('api/*')) {
                return response()->json([
                    'status' => 'success',
                    'message' => 'Reservation created successfully.',
                    'reservation' => $reservation,
                ], 201);
            }

            // Handle web response
            return redirect()->route('reservation.page')
                ->with('success', 'Your reservation has been submitted successfully!');
        }
    }

    // Show reservation details
    public function show($id)
    {
        $reservation = Reservation::findOrFail($id);

        if (request()->is('api/*')) {
            return response()->json(['reservation' => $reservation], 200);
        }

        return view('dashboard.reservations.show', compact('reservation'));
    }

    // Edit reservation
    public function edit($id)
    {
        $reservation = Reservation::findOrFail($id);
        return view('dashboard.reservations.edit', compact('reservation'));
    }

    // Update reservation
    public function update(Request $request, $id)
    {
        $reservation = Reservation::findOrFail($id);

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone_number' => 'required|string|max:15',
            'reservation_date' => 'required|date',
            'reservation_time' => 'required|date_format:H:i',
            'number_of_guests' => 'required|integer|min:1',
            'note' => 'nullable|string',
            'status' => 'nullable|string|in:pending,confirmed,cancelled',
        ]);

        $reservation->update($validated);

        if ($request->is('api/*')) {
            return response()->json([
                'message' => 'Reservation updated successfully',
                'reservation' => $reservation,
            ], 200);
        }

        return redirect()->route('dashboard.reservations.index')
            ->with('message', 'Reservation updated successfully.')
            ->with('alert', 'alert-success');
    }

    // Update reservation status
    public function updateStatus(Request $request, $id)
    {
        $reservation = Reservation::findOrFail($id);

        $validated = $request->validate([
            'status' => 'required|string|in:pending,confirmed,cancelled',
        ]);

        $oldStatus = $reservation->status;

        $reservation->update(['status' => $validated['status']]);



        if ($validated['status'] === 'completed') {
            $reservation->user->notify(new ReservationCompletedNotification($reservation));
        }


        if ($request->is('api/*')) {
            return response()->json([
                'message' => 'Reservation status updated successfully',
                'reservation' => $reservation,
            ], 200);
        }

        return redirect()->route('dashboard.reservations.index')
            ->with('message', 'Reservation status updated successfully.')
            ->with('alert', 'alert-success');
    }

    // Delete reservation
    public function destroy($id)
    {
        $reservation = Reservation::findOrFail($id);
        $reservation->delete();

        if (request()->is('api/*')) {
            return response()->json(['message' => 'Reservation deleted successfully'], 200);
        }

        return redirect()->route('dashboard.reservations.index')
            ->with('message', 'Reservation deleted successfully.')
            ->with('alert', 'alert-danger');
    }
}
