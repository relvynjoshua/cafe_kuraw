<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Reservation;

class ReservationController extends Controller
{
    public function index() {
        return view('dashboard.reservations.index');
    }

    public function store(Request $request) {
        $request->validate([
            'first_name' => ['required'],
            'last_name' => ['required'],
            'email' => ['required', 'email'],
            'tel_number' => ['required'],
            'res_date' => ['required'],
            'res_time' => ['required'],
            'guest_number' => ['required']
        ]);

        $reservation = Reservation::create([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'tel_number' => $request->tel_number,
            'res_date' => $request->res_date,
            'res_time' => $request->res_time,
            'guest_number' => $request->guest_number
        ]);

        return redirect()->route('dashboard.reservations.index')->with('success', 'Reservation created successfully!');
    }

    public function show(Reservation $reservation) {
        return view('dashboard.reservations.show', compact('reservation'));
    }

    public function edit(Reservation $reservation) {
        return view('dashboard.reservations.edit', compact('reservation'));
    }

    //update function
    //destroy function
}
