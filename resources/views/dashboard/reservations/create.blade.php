@extends('layouts.dashboard')

@section('content')

@include('components.alert')

<a href="{{ route('dashboard.reservations.index') }}" class="btn btn-secondary mb-3">Back to Reservations</a>

<div class="card shadow p-4">
    <h2 class="mb-4">Add Reservation</h2>
    <form action="{{ route('dashboard.reservations.store') }}" method="POST">
        @csrf
        <div class="form-group mb-3">
            <label for="name" class="form-label">Name</label>
            <input type="text" name="name" class="form-control" id="name" required>
            @error('name')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>

        <div class="form-group mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" name="email" class="form-control" id="email" required>
            @error('email')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>

        <div class="form-group mb-3">
            <label for="phone_number" class="form-label">Phone</label>
            <input type="text" name="phone_number" class="form-control" id="phone_number" required>
            @error('phone_number')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>

        <div class="form-group mb-3">
            <label for="reservation_date" class="form-label">Date</label>
            <input type="date" name="reservation_date" class="form-control" id="reservation_date" required>
            @error('reservation_date')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>

        <div class="form-group mb-3">
            <label for="reservation_time" class="form-label">Time</label>
            <input type="time" name="reservation_time" class="form-control" id="reservation_time" required>
            @error('reservation_time')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>

        <div class="form-group mb-3">
            <label for="number_of_guests" class="form-label">Number of Guests</label>
            <input type="number" name="number_of_guests" class="form-control" id="number_of_guests" required>
            @error('number_of_guests')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>

        <div class="form-group mb-3">
            <label for="note" class="form-label">Notes</label>
            <textarea name="note" class="form-control" id="note"></textarea>
            @error('note')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>

        <button type="submit" class="btn btn-primary">Add Reservation</button>
    </form>
</div>

@endsection
