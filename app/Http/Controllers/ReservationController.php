<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Reservation;
use Illuminate\Support\Facades\Auth;

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
        $reservations = Reservation::when($search, function ($query, $search) {
            $query->where('name', 'like', "%$search%")
                ->orWhere('reservation_date', 'like', "%$search%")
                ->orWhere('reservation_time', 'like', "%$search%")
                ->orWhere('number_of_guests', 'like', "%$search%");
        })
            ->orderBy('id', 'DESC')
            ->paginate(10);

        // API Response
        if ($request->is('api/*')) {
            return response()->json(['reservations' => $reservations], 200);
        }

        // Web Response
        return view('dashboard.reservations.index', compact('reservations'));
    }

    // Store reservation
    public function store(Request $request)
    {
        // Ensure the user is authenticated
        if (!Auth::check()) {
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

        // Check if a reservation with the same date and time already exists
        $existingReservation = Reservation::where('reservation_date', $validated['reservation_date'])
            ->where('reservation_time', $validated['reservation_time'])
            ->where('status', 'confirmed') // Ensure that only confirmed reservations are considered
            ->exists();

        if ($existingReservation) {
            return redirect()->route('reservation.page')
                ->withErrors('The selected date and time are already booked. Please choose another slot.');
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
                $admin->notify(new \App\Notifications\NewReservationNotification($reservation));
            }

            return redirect()->route('reservation.page')
                ->with('success', 'Your reservation has been submitted successfully!');
        }

        return redirect()->route('dashboard.reservations.index')
            ->with('message', 'Reservation created successfully.')
            ->with('alert', 'alert-success');
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

    // Update reservation

    public function edit($id)
    {
        $reservation = Reservation::findOrFail($id);
        return view('dashboard.reservations.edit', compact('reservation'));
    }


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

        // Restrict updates if the status is already 'completed' or 'cancelled'
        if (in_array($reservation->status, ['confirmed', 'cancelled'])) {
            return redirect()->route('dashboard.reservations.index')
                ->with(['message' => 'Cannot change the status of a confirmed or cancelled reservation.', 'alert' => 'alert-warning']);
        }
        
        $validated = $request->validate([
            'status' => 'required|string|in:pending,confirmed,cancelled',
        ]);

        $reservation->update(['status' => $validated['status']]);

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
