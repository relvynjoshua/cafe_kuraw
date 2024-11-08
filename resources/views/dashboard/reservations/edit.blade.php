@extends('layouts.dashboard')

@section('content')
    <h1>Edit Reservation</h1>
    <form action="{{ route('reservations.update', $reservation) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="name">Name</label>
            <input type="text" name="name" class="form-control" id="name" value="{{ $reservation->name }}">
        </div>
        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" name="email" class="form-control" id="email" value="{{ $reservation->email }}">
        </div>
        <div class="form-group">
            <label for="phone">Phone</label>
            <input type="text" name="phone" class="form-control" id="phone" value="{{ $reservation->phone }}">
        </div>
        <div class="form-group">
            <label for="date">Date</label>
            <input type="date" name="date" class="form-control" id="date" value="{{ $reservation->date }}">
        </div>
        <div class="form-group">
            <label for="time">Time</label>
            <input type="time" name="time" class="form-control" id="time" value="{{ $reservation->time }}">
        </div>
        <div class="form-group">
            <label for="number_of_people">Number of People</label>
            <input type="number" name="number_of_people" class="form-control" id="number_of_people" value="{{ $reservation->number_of_people }}">
        </div>
        <div class="form-group">
            <label for="notes">Notes</label>
            <textarea name="notes" class="form-control" id="notes">{{ $reservation->notes }}</textarea>
        </div>
        <button type="submit" class="btn btn-primary">Update Reservation</button>
    </form>
@endsection
