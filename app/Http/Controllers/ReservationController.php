<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Reservation;

class ReservationController extends Controller
{
    // Show the reservation form with booked dates
    public function showReservationPage()
    {
        // Fetch only confirmed reservation dates from the Reservation model
        $bookedDates = Reservation::where('status', 'confirmed')->pluck('reservation_date')->toArray();

        // If there are no booked dates, it will return an empty array
        return view('frontend.reservation', compact('bookedDates'));
    }

    // Show the list of reservations (for admin dashboard)
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

        return view('dashboard.reservations.index', compact('reservations'));
    }

    // Create reservation
    public function create()
    {
        return view('dashboard.reservations.create');
    }

    // Store reservation
    public function store(Request $request)
    {
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

        Reservation::create([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'phone_number' => $request->input('phone_number'),
            'reservation_date' => $request->input('reservation_date'),
            'reservation_time' => $request->input('reservation_time'),
            'number_of_guests' => $request->input('number_of_guests'),
            'note' => $request->input('note'),
            'status' => $request->input('status', 'pending'),
        ]);

        // Create a reservation
        $reservation = Reservation::create(array_merge($validated, ['status' => $request->input('status', 'pending')]));

        // Notify admins only if the reservation is created from the frontend
        if ($request->is('reservations/store')) {
            $admins = \App\Models\User::where('role', 'admin')->get();
            foreach ($admins as $admin) {
                $admin->notify(new \App\Notifications\NewReservationNotification($reservation));
            }

            return redirect()->route('reservation.page')->with(['success' => 'Your reservation has been submitted successfully!']);
        }

        // Redirect to admin dashboard if the reservation is created by an admin
        return redirect()->route('dashboard.reservations.index')->with(['message' => 'Reservation created successfully.', 'alert' => 'alert-success']);
    }

    // Show reservation
    public function show($id)
    {
        $reservation = Reservation::findOrFail($id);
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

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone_number' => 'required|string|max:15',
            'reservation_date' => 'required|date',
            'reservation_time' => 'required|date_format:H:i',
            'number_of_guests' => 'required|integer|min:1',
            'note' => 'nullable|string',
            'status' => 'nullable|string|in:pending,confirmed,cancelled',
        ]);

        $reservation->update([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'phone_number' => $request->input('phone_number'),
            'reservation_date' => $request->input('reservation_date'),
            'reservation_time' => $request->input('reservation_time'),
            'number_of_guests' => $request->input('number_of_guests'),
            'note' => $request->input('note'),
            'status' => $request->input('status', $reservation->status),
        ]);

        return redirect()->route('dashboard.reservations.index')->with(['message' => 'Reservation updated successfully.', 'alert' => 'alert-success']);
    }

    // Update reservation status
    public function updateStatus(Request $request, $id)
    {
        $reservation = Reservation::findOrFail($id);

        $validated = $request->validate([
            'status' => 'required|string|in:pending,confirmed,cancelled',
        ]);

        $reservation->update(['status' => $validated['status']]);

        return redirect()->route('dashboard.reservations.index')
            ->with(['message' => 'Reservation status updated successfully.', 'alert' => 'alert-success']);
    }


    // Delete reservation
    public function destroy($id)
    {
        $reservation = Reservation::findOrFail($id);
        $reservation->delete();

        return redirect()->route('dashboard.reservations.index')->with(['message' => 'Reservation deleted successfully.', 'alert' => 'alert-danger']);
    }
}