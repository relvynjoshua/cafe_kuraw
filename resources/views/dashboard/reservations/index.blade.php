@extends('layouts.dashboard')

@section('content')
    <h1>Reservations</h1>
    <a href="{{ route('dashboard.reservations.create') }}" class="btn btn-primary">Add Reservation</a>
    <table class="table">
    <thead>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Email</th>
            <th>Phone Number</th>
            <th>Reservation Date</th>
            <th>Reservation Time</th>
            <th>Number of Guests</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        @forelse ($reservations as $reservation)
            <tr>
                <td>{{ $reservation->id }}</td>
                <td>{{ $reservation->name }}</td>
                <td>{{ $reservation->email }}</td>
                <td>{{ $reservation->phone_number }}</td>
                <td>{{ $reservation->reservation_date }}</td>
                <td>{{ $reservation->reservation_time }}</td>
                <td>{{ $reservation->number_of_guests }}</td>
                <td>
                    <a href="{{ route('dashboard.reservations.edit', $reservation->id) }}" class="btn btn-warning">Edit</a>
                    <form action="{{ route('dashboard.reservations.destroy', $reservation->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Delete</button>
                    </form>
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="8">No reservations found.</td>
            </tr>
        @endforelse
    </tbody>
</table>
@endsection
