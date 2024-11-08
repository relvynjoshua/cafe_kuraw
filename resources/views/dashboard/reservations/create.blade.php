@extends('layouts.dashboard')

@section('content')
    <h1>Add Reservation</h1>
    <form action="{{ route('reservations.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="name">Name</label>
            <input type="text" name="name" class="form-control" id="name">
        </div>
        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" name="email" class="form-control" id="email">
        </div>
        <div class="form-group">
            <label for="phone">Phone</label>
            <input type="text" name="phone" class="form-control" id="phone">
        </div>
        <div class="form-group">
            <label for="date">Date</label>
            <input type="date" name="date" class="form-control" id="date">
        </div>
        <div class="form-group">
            <label for="time">Time</label>
            <input type="time" name="time" class="form-control" id="time">
        </div>
        <div class="form-group">
            <label for="number_of_people">Number of People</label>
            <input type="number" name="number_of_people" class="form-control" id="number_of_people">
        </div>
        <div class="form-group">
            <label for="notes">Notes</label>
            <textarea name="notes" class="form-control" id="notes"></textarea>
        </div>
        <button type="submit" class="btn btn-primary">Add Reservation</button>
    </form>
@endsection
