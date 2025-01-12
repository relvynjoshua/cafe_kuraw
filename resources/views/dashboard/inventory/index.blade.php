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
        color: #007bff;
        text-decoration: none;
        border: 1px solid #ddd;
        border-radius: 3px;
        background-color: #fff;
        transition: background-color 0.3s, color 0.3s;
        font-size: 1rem;
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
        padding: 6px 10px;
    }

    /* Scrollable table container */
    .table-responsive {
        overflow-x: auto;
        white-space: nowrap;
        background-color: #f9f9f9;
        /* Set the table background to white */
        padding: 15px;
        border-radius: 8px;
    }

    table {
        width: 100%;
        max-width: 100%;
        table-layout: auto;
        border-collapse: collapse;
    }

    th,
    td {
        text-align: center;
        vertical-align: middle;
        padding: 10px;
        font-size: 0.9rem;
        border: 1px solid #ddd;
        /* Add borders to table cells */
    }

    th {
        background-color: #f5f5f5;
        /* Light gray background for table headers */
        font-weight: bold;
    }

    /* Adjusting the Actions column */
    td:nth-child(10),
    th:nth-child(10) {
        min-width: 150px;
        /* Adjust the width to make it spacious */
    }

    .action-buttons {
        display: flex;
        justify-content: space-evenly;
        align-items: center;
        gap: 5px;
    }

    .action-buttons a,
    .action-buttons button {
        display: inline-block;
        font-size: 0.85rem;
        padding: 5px 8px;
        border-radius: 5px;
        text-align: center;
        white-space: nowrap;
    }

    .btn-warning {
        background-color: #ffc107;
        color: white;
    }

    .btn-danger {
        background-color: #dc3545;
        color: white;
    }

    .btn-warning:hover {
        background-color: #e0a800;
    }

    .btn-danger:hover {
        background-color: #c82333;
    }

    /* Adjust Stock Adjustment column */
    td:nth-child(12),
    th:nth-child(12) {
        min-width: 280px;
        /* Ensure the column is wide enough */
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

    /* Responsive adjustments for smaller screens */
    @media (max-width: 768px) {
        table {
            font-size: 0.8rem;
        }

        th,
        td {
            padding: 5px;
        }

        .action-buttons {
            flex-direction: column;
            /* Stack buttons on smaller screens */
        }

        .pagination a {
            font-size: 0.85rem;
            padding: 4px 8px;
        }
    }
</style>

<div class="container mt-4" style="max-width: 100%; width: 98%;">
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

    <div class="table-responsive">
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
                            <div class="action-buttons">
                                <a href="{{ route('dashboard.inventory.edit', $inventory->id) }}"
                                    class="btn btn-warning btn-sm">
                                    <i class="fas fa-edit"></i> Edit
                                </a>
                                <form action="{{ route('dashboard.inventory.destroy', $inventory->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm"><i class="fas fa-trash-alt"></i>
                                        Delete</button>
                                </form>
                            </div>
                        </td>
                        <td>
                        @if ($inventory->quantity < 0)
                            <span class="badge badge-danger" style="background-color: red; color: white;">Invalid Quantity</span>
                        @elseif ($inventory->quantity == 0)
                            <span class="badge badge-danger" style="background-color: red; color: white;">Out of Stock</span>
                        @elseif ($inventory->quantity > 0 && $inventory->quantity <= 10)
                            <span class="badge badge-warning" style="background-color: orange; color: white;">Low Stock</span>
                        @elseif ($inventory->quantity > 10 && $inventory->quantity <= 50)
                            <span class="badge badge-success" style="background-color: green; color: white;">Sufficient</span>
                        @elseif ($inventory->quantity > 50 && $inventory->quantity <= 100)
                            <span class="badge badge-info" style="background-color: blue; color: white;">High</span>
                        @else
                            <span class="badge badge-primary" style="background-color: purple; color: white;">Overstocked</span>
                        @endif
                    </td>

                    <td>
                        <form action="{{ route('dashboard.inventory.updateQuantity', $inventory->id) }}" method="POST" onsubmit="return validateQuantityForm(this)">
                            @csrf
                            <div class="input-group" style="margin-top: 10px;">
                                <select name="change_type" class="form-select">
                                    <option value="add">Add</option>
                                    <option value="subtract">Subtract</option>
                                </select>
                                <input type="number" name="quantity" class="form-control" placeholder="Qty" required min="1">
                                <button class="btn btn-primary" type="submit">Update</button>
                            </div>
                            <span id="quantityError" class="text-danger d-none">Quantity must be a positive number.</span>
                        </form>
                    </td>

                @empty
                    <tr>
                        <td colspan="12" class="text-center">No inventory items found.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <!-- Pagination Links -->
    <div class="pagination">
        <a href="#" class="arrow" onclick="changePage('prev')">«</a>
        <span>Page {{ $inventories->currentPage() }} of {{ $inventories->lastPage() }}</span>
        <a href="#" class="arrow" onclick="changePage('next')">»</a>
    </div>
</div>

<script>
    function changePage(direction) {
        const currentPage = {{ $inventories->currentPage() }};
        let newPage = direction === 'next' ? currentPage + 1 : currentPage - 1;
        if (newPage < 1) newPage = 1;
        if (newPage > {{ $inventories->lastPage() }}) newPage = {{ $inventories->lastPage() }};
        window.location.href = '{{ route('dashboard.inventory.index') }}?page=' + newPage;
    }

    function validateQuantityForm(form) {
        const quantityInput = form.querySelector('input[name="quantity"]');
        const errorSpan = form.querySelector('#quantityError');

        if (quantityInput.value <= 0) {
            errorSpan.classList.remove('d-none');
            return false; // Prevent form submission
        }

        errorSpan.classList.add('d-none');
        return true; // Allow form submission
    }
</script>

@endsection