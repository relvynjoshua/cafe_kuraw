@extends('layouts.dashboard')

@section('content')
    <h1>Reservation Details</h1>
    <table class="table">
        <tr><th>ID</th><td>{{ $reservation->id }}</td></tr>
        <tr><th>Name</th><td>{{ $reservation->name }}</td></tr>
        <tr><th>Email</th><td>{{ $reservation->email }}</td></tr>
        <tr><th>Phone</th><td>{{ $reservation->phone_number }}</td></tr>
        <tr><th>Date</th><td>{{ $reservation->reservation_date }}</td></tr>
        <tr><th>Time</th><td>{{ $reservation->reservation_time }}</td></tr>
        <tr><th>Guests</th><td>{{ $reservation->number_of_guests }}</td></tr>
        <tr><th>Notes</th><td>{{ $reservation->note }}</td></tr>
    </table>
    <a href="{{ route('dashboard.reservations.index') }}" class="btn btn-secondary">Back to Reservations</a>
@endsection
