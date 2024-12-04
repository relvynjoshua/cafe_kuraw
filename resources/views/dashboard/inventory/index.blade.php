@extends('layouts.dashboard')

@section('content')

@include('components.alert')

<style>
    /* Styling for pagination */
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

    /* Styling for the container */
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
        <i class="fas fa-warehouse"></i> Inventory
    </h1>
    <h6>List of all inventory items</h6>

    <!-- Search Bar -->
    <form action="{{ route('dashboard.inventory.index') }}" method="GET" class="d-flex mb-3">
        <input type="text" name="search" class="form-control me-2" placeholder="Search by Item Name, Price, Category, Supplier, or Location" value="{{ request('search') }}">
        <button class="btn btn-outline-primary" type="submit">Search</button>
    </form>

    <a href="{{ route('dashboard.inventory.create') }}" class="btn btn-primary mb-3">Add Inventory Item</a>

    <table class="table table-striped table-bordered">
        <thead class="thead-dark">
            <tr>
                <th scope="col">ID</th>
                <th scope="col">Item Name</th>
                <th scope="col">Quantity</th>
                <th scope="col">Unit</th>
                <th scope="col">Price</th>
                <th scope="col">Category</th>
                <th scope="col">Supplier</th>
                <th scope="col">Location</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($inventories as $inventory)
                <tr>
                    <td>{{ $inventory->id }}</td>
                    <td>{{ $inventory->item_name }}</td>
                    <td>{{ $inventory->quantity }}</td>
                    <td>{{ $inventory->unit }}</td>
                    <td>{{ $inventory->price }}</td>
                    <td>{{ $inventory->category->name ?? 'N/A' }}</td>
                    <td>{{ $inventory->supplier->company_name ?? 'N/A' }}</td>
                    <td>{{ $inventory->location ?? 'N/A' }}</td>
                    <td>
                        <a href="{{ route('dashboard.inventory.edit', $inventory->id) }}" class="btn btn-warning btn-sm">
                            <i class="fas fa-edit"></i> Edit
                        </a>
                        <form action="{{ route('dashboard.inventory.destroy', $inventory->id) }}" method="POST" style="display:inline;">
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
                    <td colspan="9" class="text-center">No inventory items found.</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <!-- Pagination Links -->
    <div class="d-flex justify-content-center mt-3">
        {{ $inventories->appends(request()->query())->links() }}
    </div>
</div>

@endsection
