<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Reservation;

class ReservationController extends Controller
{
    // Show the list of reservations
    public function index(Request $request)
    {
        // Get search query
        $search = $request->input('search');

        // Fetch reservations with optional search filters
        $reservations = Reservation::when($search, function ($query, $search) {
            $query->where('name', 'like', "%$search%")
                ->orWhere('reservation_date', 'like', "%$search%")
                ->orWhere('reservation_time', 'like', "%$search%")
                ->orWhere('number_of_guests', 'like', "%$search%");
        })
        ->orderBy('id', 'DESC')
        ->paginate(10); // Adjust pagination size as needed

        return view('dashboard.reservations.index', compact('reservations'));
    }

    // Show all added reservations
    public function showAdd() 
    {
        $reservation = Reservation::all();
        return view('dashboard.reservations.create', compact('reservation'));
    }

    // Show single reservation
    public function show($id) 
    {
        $reservation = Reservation::find($id);
        return view('dashboard.reservations.show', compact('reservation'));
    }

    // Show the form to create a new reservation
    public function create() 
    {
        $reservation = Reservation::create();
        return view('dashboard.reservations.create', compact('reservation'));
    }

    // Store reservation
    public function store(Request $request) 
    {
        $request->validate([
            'name' => ['required'],
            'email' => ['required'],
            'phone_number' => ['required'],
            'reservation_date' => ['required'],
            'reservation_time' => ['required'],
            'number_of_guests' => ['required'],
            'note' => ['required'],
        ]);

        Reservation::create([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'phone_number' => $request->input('phone_number'),
            'reservation_date' => $request->input('reservation_date'),
            'reservation_time' => $request->input('reservation_time'),
            'number_of_guests' => $request->input('number_of_guests'),
            'note' => $request->input('note'),
        ]);

        return redirect()->route('dashboard.reservations.index')->with(['message' => 'Reservation added', 'alert' => 'alert-success']);
    }

    // Edit reservation
    public function edit($id) 
    {
        $reservation = Reservation::find($id);  
        return view('dashboard.reservations.edit', compact('reservation'));
    }

    // Update reservation
    public function update($id, Request $request) 
    {
        $reservation = Reservation::find($id);
        
        $request->validate([
            'name' => ['required'],
            'email' => ['required|email'],
            'phone_number' => ['required'],
            'reservation_date' => ['required'],
            'reservation_time' => ['required'],
            'number_of_guests' => ['required'],
            'note' => ['required']
        ]);

        $reservation->name = $request->name;
        $reservation->email = $request->email;
        $reservation->phone_number = $request->phone_number;
        $reservation->reservation_date = $request->reservation_date;
        $reservation->reservation_time = $request->reservation_time;
        $reservation->number_of_guests = $request->number_of_guests;
        $reservation->note = $request->note;

        $reservation->save();

        return redirect()->route('dashboard.reservation.index')->with(['message' => 'Reservation updated', 'alert' => 'alert-success']);
    }
    
    // Delete reservation
    public function destroy($id)
    {
        $reservation = Reservation::find($id);
        $reservation->delete();

        return redirect()->route('dashboard.reservation.index')->with(['message' => 'Reservation deleted', 'alert' => 'alert-success']);
    }
}