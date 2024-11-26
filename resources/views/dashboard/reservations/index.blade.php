@extends('layouts.dashboard')

@section('content')

@include('components.alert')

<div class="d-flex justify-content-between align-items-center mb-4">
    <h1>Reservation List</h1>
    <a href="{{ route('dashboard.reservations.create') }}" class="btn btn-primary">Add Reservation</a>
</div>

<div class="card shadow">
    <div class="card-body">
        <table class="table table-striped">
            <thead class="thead-dark">
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
                            <a href="{{ route('dashboard.reservations.edit', $reservation->id) }}"
                                class="btn btn-warning btn-sm">Edit</a>
                            <form action="{{ route('dashboard.reservations.destroy', $reservation->id) }}" method="POST"
                                style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">Delete</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="8" class="text-center">No reservations found.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

@endsection