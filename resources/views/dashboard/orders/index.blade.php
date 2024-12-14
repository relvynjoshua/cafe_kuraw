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

    .status-dropdown[data-status="completed"] {
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
</style>

<div class="d-flex justify-content-between align-items-center mb-4">
    <h1 class="mb-0"><i class="fas fa-shopping-cart"></i> Orders</h1>
    <h6>List of all customer orders</h6>
    <a href="{{ route('dashboard.orders.create') }}" class="btn btn-primary">
        <i class="fas fa-plus"></i> Add Order
    </a>
</div>

<!-- Search Form -->
<div class="mb-4">
    <form action="{{ route('dashboard.orders.index') }}" method="GET">
        <div class="input-group">
            <input type="text" name="search" class="form-control"
                placeholder="Search orders by name, email, or phone..." value="{{ request('search') }}">
            <div class="input-group-append">
                <button class="btn btn-outline-secondary" type="submit">Search</button>
            </div>
        </div>
    </form>
</div>

<!-- Orders Table -->
<div class="card shadow">
    <div class="card-body">
        <table class="table table-striped table-responsive-sm table-bordered">
            <thead class="thead-dark">
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Customer Name</th>
                    <th scope="col">Email</th>
                    <th scope="col">Phone</th>
                    <th scope="col">Total Amount</th>
                    <th scope="col">Products</th> <!-- Column for products -->
                    <th scope="col">Status</th>
                    <th scope="col">Payment</th> <!-- Column for Payment -->
                    <th scope="col">Delivery</th> <!-- Column for Delivery -->
                    <th scope="col">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($orders as $order)
                    <tr>
                        <td scope="row">{{ $order->id }}</td>
                        <td>{{ $order->customer_name }}</td>
                        <td>{{ $order->email }}</td>
                        <td>{{ $order->phone }}</td>
                        <td>₱{{ number_format($order->total_amount, 2) }}</td>
                        <td>
                            @if ($order->products->count() > 0)
                                <table class="table table-sm table-bordered variation-table">
                                    <thead>
                                        <tr>
                                            <th>Product Name</th>
                                            <th>Variation</th>
                                            <th>Quantity</th>
                                            <th>Price</th>
                                            <th>Total</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($order->products as $product)
                                            <tr>
                                                <td>{{ $product->name }}</td>
                                                <td>{{ $product->pivot->variation ?? 'No Variation' }}</td>
                                                <td>{{ $product->pivot->quantity }}</td>
                                                <td>₱{{ number_format($product->pivot->price, 2) }}</td>
                                                <td>₱{{ number_format($product->pivot->quantity * $product->pivot->price, 2) }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            @else
                                <span>No Products</span>
                            @endif
                        </td>
                        <td>
                            <form action="{{ route('dashboard.orders.updateStatus', $order->id) }}" method="POST">
                                @csrf
                                @method('PUT')
                                <select name="status" class="form-select status-dropdown" onchange="this.form.submit()"
                                    data-status="{{ $order->status }}">
                                    <option value="pending" {{ $order->status == 'pending' ? 'selected' : '' }}>Pending
                                    </option>
                                    <option value="completed" {{ $order->status == 'completed' ? 'selected' : '' }}>Completed
                                    </option>
                                    <option value="cancelled" {{ $order->status == 'cancelled' ? 'selected' : '' }}>Cancelled
                                    </option>
                                </select>
                            </form>
                        </td>

                        <td>{{ ucfirst($order->payment_method) }}</td>
                        <td>{{ ucfirst($order->delivery_method) }}</td>

                        <td class="d-flex">
                            <a href="{{ route('dashboard.orders.show', $order->id) }}" class="btn btn-info btn-sm">
                                <i class="fas fa-eye"></i> View
                            </a>
                            <a href="{{ route('dashboard.orders.edit', $order->id) }}" class="btn btn-warning btn-sm mr-2"
                                data-toggle="tooltip" data-placement="top" title="Edit Order">
                                <i class="fas fa-edit"></i> Edit
                            </a>
                            <form action="{{ route('dashboard.orders.destroy', $order->id) }}" method="POST"
                                style="display:inline;"
                                onsubmit="return confirm('Are you sure you want to delete this order?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm" data-toggle="tooltip"
                                    data-placement="top" title="Delete Order">
                                    <i class="fas fa-trash-alt"></i> Delete
                                </button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="10" class="text-center">No orders found.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>


        <!-- Pagination Links -->
        <div class="pagination">
            <!-- Previous arrow -->
            <a href="#" class="arrow" onclick="changePage('prev')">«</a>

            <!-- Page Numbers -->
            <span>Page {{ $orders->currentPage() }} of {{ $orders->lastPage() }}</span>

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
        const currentPage = {{ $orders->currentPage() }};
        let newPage = direction === 'next' ? currentPage + 1 : currentPage - 1;
        if (newPage < 1) newPage = 1;
        if (newPage > {{ $orders->lastPage() }}) newPage = {{ $orders->lastPage() }};
        window.location.href = '{{ route('dashboard.orders.index') }}?page=' + newPage;
    }
</script>
@endsection