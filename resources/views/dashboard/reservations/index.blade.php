@extends('layouts.dashboard')

@section('content')

@include('components.alert')

<style>
    /* Pagination Styling */
    .pagination .page-link {
        font-size: 12px;
        padding: 5px 10px;
        color: #007bff;
        border: 1px solid #dee2e6;
    }

    .pagination .page-link:hover {
        color: #0056b3;
        text-decoration: none;
    }

    .pagination .page-item.active .page-link {
        background-color: #007bff;
        color: #fff;
        border-color: #007bff;
    }

    .pagination .page-item {
        margin: 0 2px;
    }

    /* Container Styling */
    .container {
        background-color: #f9f9f9;
        padding: 20px;
        border-radius: 8px;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    }

    h1, h6 {
        color: #333;
    }
</style>

<div class="container mt-4">
    <h1>
        <i class="fas fa-calendar-alt"></i> Reservations
    </h1>
    <h6>List of all reservations</h6>

    <!-- Search Bar -->
    <form action="{{ route('dashboard.reservations.index') }}" method="GET" class="d-flex mb-3">
        <input type="text" name="search" class="form-control me-2" placeholder="Search by Name, Date, or Status" value="{{ request('search') }}">
        <button class="btn btn-outline-primary" type="submit">Search</button>
    </form>

    <!-- Add Reservation Button -->
    <a href="{{ route('dashboard.reservations.create') }}" class="btn btn-primary mb-3">
        <i class="fas fa-plus"></i> Add Reservation
    </a>

    <!-- Reservations Table -->
    <table class="table table-striped table-bordered">
        <thead class="thead-dark">
            <tr>
                <th scope="col">ID</th>
                <th scope="col">Name</th>
                <th scope="col">Email</th>
                <th scope="col">Phone</th>
                <th scope="col">Date</th>
                <th scope="col">Time</th>
                <th scope="col">Guests</th>
                <th scope="col">Status</th>
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
                        <span class="badge 
                            {{ $reservation->status == 'pending' ? 'bg-warning' : ($reservation->status == 'confirmed' ? 'bg-success' : 'bg-danger') }}">
                            {{ ucfirst($reservation->status) }}
                        </span>
                    </td>
                    <td>
                        <!-- Edit Button -->
                        <a href="{{ route('dashboard.reservations.edit', $reservation->id) }}" class="btn btn-warning btn-sm">
                            <i class="fas fa-edit"></i> Edit
                        </a>

                        <!-- Delete Form -->
                        <form action="{{ route('dashboard.reservations.destroy', $reservation->id) }}" method="POST" style="display:inline;" onsubmit="return confirm('Are you sure you want to delete this reservation?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm">
                                <i class="fas fa-trash-alt"></i> Delete
                            </button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="9" class="text-center">No reservations found.</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <!-- Pagination Links -->
    <div class="d-flex justify-content-center mt-3">
        {{ $reservations->appends(request()->query())->links() }}
    </div>
</div>

@endsection
