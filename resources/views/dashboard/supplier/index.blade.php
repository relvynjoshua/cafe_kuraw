@extends('layouts.dashboard')

@section('content')

@include('components.alert')

<style>
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

    /* Styling for the container */
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
        <i class="fas fa-truck"></i> Suppliers
    </h1>
    <h6>List of all suppliers</h6>

    <!-- Search Bar -->
    <form action="{{ route('dashboard.supplier.index') }}" method="GET" class="d-flex mb-3">
        <input type="text" name="search" class="form-control me-2"
            placeholder="Search by Company Name, Contact Person, or Email" value="{{ request('search') }}">
        <button class="btn btn-outline-primary" type="submit">Search</button>
    </form>

    <a href="{{ route('dashboard.supplier.create') }}" class="btn btn-primary mb-3">
        <i class="fas fa-plus"></i> Add Supplier
    </a>

    <table class="table table-striped table-bordered">
        <thead class="thead-dark">
            <tr>
                <th>ID</th>
                <th>Company Name</th>
                <th>Contact Person</th>
                <th>Phone Number</th>
                <th>Email</th>
                <th>Address</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($suppliers as $supplier)
                <tr>
                    <td>{{ $supplier->id }}</td>
                    <td>{{ $supplier->company_name }}</td>
                    <td>{{ $supplier->contact_person }}</td>
                    <td>{{ $supplier->phone_number }}</td>
                    <td>{{ $supplier->email }}</td>
                    <td>{{ $supplier->address }}</td>
                    <td>
                        <a href="{{ route('dashboard.supplier.edit', $supplier) }}" class="btn btn-warning btn-sm">
                            <i class="fas fa-edit"></i> Edit
                        </a>
                        <form action="{{ route('dashboard.supplier.destroy', $supplier) }}" method="POST"
                            style="display: inline;">
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
                    <td colspan="7" class="text-center">No suppliers found.</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <!-- Pagination Links -->
    <div class="pagination">
        <!-- Previous arrow -->
        <a href="#" class="arrow" onclick="changePage('prev')">«</a>

        <!-- Page Numbers -->
        <span>Page {{ $suppliers->currentPage() }} of {{ $suppliers->lastPage() }}</span>

        <!-- Next arrow -->
        <a href="#" class="arrow" onclick="changePage('next')">»</a>
    </div>
</div>
</div>

<script>
    // Function to change pages
    function changePage(direction) {
        const currentPage = {{ $suppliers->currentPage() }};
        let newPage = direction === 'next' ? currentPage + 1 : currentPage - 1;
        if (newPage < 1) newPage = 1;
        if (newPage > {{ $suppliers->lastPage() }}) newPage = {{ $suppliers->lastPage() }};
        window.location.href = '{{ route('dashboard.supplier.index') }}?page=' + newPage;
    }
</script>

@endsection