@extends('layouts.dashboard')

@section('content')
<div class="container">
    <h1>Reservation Details</h1>
    <div class="card">
        <div class="card-body">
            <h5 class="card-title">{{ $reservation->name }}</h5>
            <p class="card-text">
                <strong>Email:</strong> {{ $reservation->email }}<br>
                <strong>Phone:</strong> {{ $reservation->phone_number }}<br>
                <strong>Reservation Date:</strong> {{ $reservation->reservation_date }}<br>
                <strong>Reservation Time:</strong> {{ $reservation->reservation_time }}<br>
                <strong>Number of Guests:</strong> {{ $reservation->number_of_guests }}<br>
                <strong>Note:</strong> {{ $reservation->note }}<br>
                <strong>Status:</strong> {{ ucfirst($reservation->status) }}
            </p>
            <a href="{{ route('dashboard.reservations.index') }}" class="btn btn-primary">Back to Reservations</a>
        </div>
    </div>
</div>
@endsection
