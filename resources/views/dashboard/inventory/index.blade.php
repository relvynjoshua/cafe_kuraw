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
    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <h1>
        <i class="fas fa-warehouse"></i> Inventory
    </h1>
    <h6>List of all inventory items</h6>

    <!-- Search Bar -->
    <form action="{{ route('dashboard.inventory.index') }}" method="GET" class="d-flex mb-3">
        <input type="text" name="search" class="form-control me-2"
            placeholder="Search by Item Name, Price, Category, Supplier, or Location" value="{{ request('search') }}">
        <button class="btn btn-outline-primary" type="submit">Search</button>
    </form>

    <a href="{{ route('dashboard.inventory.create') }}" class="btn btn-primary mb-3">
        <i class="fas fa-plus"></i> Add Inventory Item
    </a>

    <table class="table table-striped table-bordered">
        <thead class="thead-dark">
            <tr>
                <th scope="col">ID</th>
                <th scope="col">Item Name</th>
                <th scope="col">Description</th>
                <th scope="col">Quantity</th>
                <th scope="col">Unit</th>
                <th scope="col">Price</th>
                <th scope="col">Category</th>
                <th scope="col">Supplier of Item</th>
                <th scope="col">Bought Location</th>
                <th scope="col">Actions</th>
                <th scope="col">Stock Level</th>
                <th scope="col">Stock Adjustment</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($inventories as $inventory)
                <tr>
                    <td>{{ $inventory->id }}</td>
                    <td>{{ $inventory->item_name }}</td>
                    <td>{{ $inventory->description }}</td>
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
                        <form action="{{ route('dashboard.inventory.destroy', $inventory->id) }}" method="POST"
                            style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm">
                                <i class="fas fa-trash-alt"></i> Delete
                            </button>
                        </form>
                    </td>
                    <td>
                        @if ($inventory->quantity <= $inventory->low_stock_threshold)
                            <span class="badge badge-warning" style="color: red; font-size: 1.0em;">Low Stock</span>
                        @endif
                    </td>
                    <td>
                        <!-- Display current quantity -->
                        <div style="margin-bottom: 10px;">
                            <label for="current_quantity_{{ $inventory->id }}" class="font-weight-bold">Current
                                Quantity:</label>
                            <input type="number" id="current_quantity_{{ $inventory->id }}"
                                value="{{ $inventory->quantity }}" class="form-control text-center" readonly
                                style="background-color: #f8f9fa; border: 1px solid #ced4da; width: 100px; margin-bottom: 5px;">
                        </div>

                        <!-- Form for Add/Subtract -->
                        <form action="{{ route('dashboard.inventory.updateQuantity', $inventory->id) }}" method="POST">
                            @csrf
                            <div class="input-group" style="max-width: 300px;">
                                <!-- Dropdown for Add/Subtract -->
                                <select name="change_type" class="form-control" style="width: 40%;" required>
                                    <option value="add">Add Item</option>
                                    <option value="subtract">Subtract Item</option>
                                </select>

                                <!-- Input field for quantity -->
                                <input type="number" name="quantity" class="form-control text-center"
                                    placeholder="Enter Quantity" min="1" required style="width: 50%;">

                                <!-- Submit Button -->
                                <div class="input-group-append">
                                    <button type="submit" class="btn btn-primary">
                                        Update
                                    </button>
                                </div>
                            </div>
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
    <div class="pagination">
        <!-- Previous arrow -->
        <a href="#" class="arrow" onclick="changePage('prev')">«</a>

        <!-- Page Numbers -->
        <span>Page {{ $inventories->currentPage() }} of {{ $inventories->lastPage() }}</span>

        <!-- Next arrow -->
        <a href="#" class="arrow" onclick="changePage('next')">»</a>
    </div>
</div>
</div>

<script>
    // Function to change pages
    function changePage(direction) {
        const currentPage = {{ $inventories->currentPage() }};
        let newPage = direction === 'next' ? currentPage + 1 : currentPage - 1;
        if (newPage < 1) newPage = 1;
        if (newPage > {{ $inventories->lastPage() }}) newPage = {{ $inventories->lastPage() }};
        window.location.href = '{{ route('dashboard.inventory.index') }}?page=' + newPage;
    }
</script>

@endsection