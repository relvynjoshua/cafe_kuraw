@extends('layouts.dashboard')

@section('content')

@include('components.alert')

<style>
    .status-dropdown {
        background-color: #f0f0f0;
        /* Default color */
        color: #000;
        /* Default text color */
        border: 1px solid #ccc;
        padding: 5px;
        border-radius: 5px;
    }

    .status-dropdown[data-status="pending"] {
        background-color: #ffc107;
        /* Yellow for pending */
        color: #000;
        /* Black text for pending */
    }

    .status-dropdown[data-status="confirmed"] {
        background-color: #28a745;
        /* Green for completed */
        color: #fff;
        /* White text for completed */
    }

    .status-dropdown[data-status="cancelled"] {
        background-color: #dc3545;
        /* Red for cancelled */
        color: #fff;
        /* White text for cancelled */
    }

    /* Pagination container */
    .pagination {
        display: flex;
        justify-content: center;
        align-items: center;
        margin-top: 20px;
    }

    /* Pagination list */
    .pagination ul {
        list-style-type: none;
        padding: 0;
        margin: 0;
        display: flex;
    }

    /* Pagination items */
    .pagination li {
        margin: 0 5px;
    }

    /* Pagination links */
    .pagination a {
        display: inline-block;
        padding: 6px 12px;
        /* Adjusted padding for better button size */
        color: #007bff;
        text-decoration: none;
        border: 1px solid #ddd;
        border-radius: 3px;
        background-color: #fff;
        transition: background-color 0.3s, color 0.3s;
        font-size: 1rem;
        /* Adjusted font size for page numbers */
        line-height: 1.5;
    }

    /* Hover and active state */
    .pagination a:hover,
    .pagination .active a {
        background-color: #007bff;
        color: white;
    }

    /* Disabled state */
    .pagination .disabled a {
        color: #ccc;
        pointer-events: none;
    }

    /* Arrow buttons */
    .pagination .arrow {
        font-size: 1.2rem;
        /* Make the arrows a bit bigger */
        padding: 6px 10px;
    }

    /* Arrow hover effect */
    .pagination .arrow:hover {
        background-color: #007bff;
        color: white;
    }

    /* Adjust spacing and layout for responsiveness */
    @media (max-width: 768px) {
        .pagination .page-link {
            font-size: 10px;
            /* Smaller font size on smaller screens */
            padding: 3px 6px;
            /* Adjust padding for compact display */
        }
    }

    /* Container Styling */
    .container {
        background-color: #f9f9f9;
        padding: 20px;
        border-radius: 8px;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    }

    h1,
    h6 {
        color: #333;
    }
</style>

<div class="container mt-4" style="max-width: 100%; width: 90%;">
    <h1>
        <i class="fas fa-calendar-alt"></i> Reservations
    </h1>
    <h6>List of all reservations</h6>

    <!-- Search Bar -->
    <form action="{{ route('dashboard.reservations.index') }}" method="GET" class="d-flex mb-3">
        <input type="text" name="search" class="form-control me-2" placeholder="Search by Name, Date, or Status"
            value="{{ request('search') }}">
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
                <th scope="col">Notes</th>
                <th scope="col">Status</th>
                <th scope="col">Actions</th>
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
                    <td>{{ $reservation->note ?? 'No Notes' }}</td>
                    <td>
                        <form action="{{ route('dashboard.reservations.update-status', $reservation->id) }}" method="POST"
                            class="d-inline">
                            @csrf
                            @method('PATCH')
                            <select name="status" class="form-select status-dropdown" onchange="this.form.submit()"
                                data-status="{{ $reservation->status }}" {{ in_array($reservation->status, ['confirmed', 'cancelled']) ? 'disabled' : '' }}>
                                <option value="pending" {{ $reservation->status == 'pending' ? 'selected' : '' }}>Pending
                                </option>
                                <option value="confirmed" {{ $reservation->status == 'confirmed' ? 'selected' : '' }}>
                                    Confirmed</option>
                                <option value="cancelled" {{ $reservation->status == 'cancelled' ? 'selected' : '' }}>
                                    Cancelled</option>
                            </select>
                        </form>
                    </td>
                    <td>

                        <!-- Delete Form -->
                        <form action="{{ route('dashboard.reservations.destroy', $reservation->id) }}" method="POST"
                            style="display:inline;"
                            onsubmit="return confirm('Are you sure you want to delete this reservation?');">
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
    <div class="pagination">
        <!-- Previous arrow -->
        <a href="#" class="arrow" onclick="changePage('prev')">«</a>

        <!-- Page Numbers -->
        <span>Page {{ $reservations->currentPage() }} of {{ $reservations->lastPage() }}</span>

        <!-- Next arrow -->
        <a href="#" class="arrow" onclick="changePage('next')">»</a>
    </div>
</div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const dropdowns = document.querySelectorAll('.status-dropdown');

        dropdowns.forEach(dropdown => {
            dropdown.addEventListener('change', function () {
                this.dataset.status = this.value; // Update the data-status attribute
            });
        });
    });
</script>
<script>
    // Function to change pages
    function changePage(direction) {
        const currentPage = {{ $reservations->currentPage() }};
        let newPage = direction === 'next' ? currentPage + 1 : currentPage - 1;
        if (newPage < 1) newPage = 1;
        if (newPage > {{ $reservations->lastPage() }}) newPage = {{ $reservations->lastPage() }};
        window.location.href = '{{ route('dashboard.reservations.index') }}?page=' + newPage;
    }
</script>

@endsection