@extends('layouts.dashboard')

@section('content')
    <h1>Add Reservation</h1>
    <form action="{{ route('dashboard.reservations.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="name">Name</label>
            <input type="text" name="name" class="form-control" id="name" required>
            @error('name')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>
        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" name="email" class="form-control" id="email" required>
            @error('email')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>
        <div class="form-group">
            <label for="phone_number">Phone</label>
            <input type="text" name="phone_number" class="form-control" id="phone_number" required>
            @error('phone_number')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>
        <div class="form-group">
            <label for="reservation_date">Date</label>
            <input type="date" name="reservation_date" class="form-control" id="reservation_date" required>
            @error('reservation_date')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>
        <div class="form-group">
            <label for="reservation_time">Time</label>
            <input type="time" name="reservation_time" class="form-control" id="reservation_time" required>
            @error('reservation_time')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>
        <div class="form-group">
            <label for="number_of_guests">Number of Guests</label>
            <input type="number" name="number_of_guests" class="form-control" id="number_of_guests" required>
            @error('number_of_guests')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>
        <div class="form-group">
            <label for="note">Notes</label>
            <textarea name="note" class="form-control" id="note"></textarea>
            @error('note')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>
        <button type="submit" class="btn btn-primary">Add Reservation</button>
    </form>
@endsection
