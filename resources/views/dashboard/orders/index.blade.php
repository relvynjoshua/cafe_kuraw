@extends('layouts.dashboard')

@section('content')

@include('components.alert')

<div class="d-flex justify-content-between align-items-center mb-4">
    <h1 class="mb-0">Orders</h1>
    <a href="{{ route('dashboard.orders.create') }}" class="btn btn-primary">Add Order</a>
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
        <table class="table table-striped table-responsive-sm">
            <thead class="thead-dark">
                <tr>
                    <th>ID</th>
                    <th>Customer Name</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Total Amount</th>
                    <th>Products</th> <!-- Column for products -->
                    <th>Status</th>
                    <th>Payment</th> <!-- Column for Payment -->
                    <th>Delivery</th> <!-- Column for Delivery -->
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($orders as $order)
                    <tr>
                        <td>{{ $order->id }}</td>
                        <td>{{ $order->customer_name }}</td>
                        <td>{{ $order->email }}</td>
                        <td>{{ $order->phone }}</td>
                        <td>${{ number_format($order->total_amount, 2) }}</td>
                        <td>
                            <!-- Display the names of the products associated with the order -->
                            @foreach ($order->products as $product)
                                <div>{{ $product->name }} (x{{ $product->pivot->quantity }})</div>
                            @endforeach
                        </td>
                        <td>
                            <span class="badge 
                                {{ $order->status == 'pending' ? 'bg-warning' : 
                                   ($order->status == 'completed' ? 'bg-success' : 
                                   ($order->status == 'cancelled' ? 'bg-danger' : '')) }}">
                                {{ ucfirst($order->status) }}
                            </span>
                        </td>
                        <td>{{ ucfirst($order->payment_method) }}</td>
                        <td>{{ ucfirst($order->delivery_method) }}</td>
                        <!-- Assuming there's a delivery_status field -->

                        <td class="d-flex">
                            <a href="{{ route('dashboard.orders.edit', $order->id) }}" class="btn btn-warning btn-sm mr-2"
                                data-toggle="tooltip" data-placement="top" title="Edit Order">Edit</a>
                            <form action="{{ route('dashboard.orders.destroy', $order->id) }}" method="POST"
                                style="display:inline;"
                                onsubmit="return confirm('Are you sure you want to delete this order?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm" data-toggle="tooltip"
                                    data-placement="top" title="Delete Order">Delete</button>
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
        <div class="d-flex justify-content-center mt-4">
            {{ $orders->links() }}
        </div>
    </div>
</div>

@endsection

@section('scripts')
<script>
    // Initialize Bootstrap tooltips
    $(function () {
        $('[data-toggle="tooltip"]').tooltip();
    });
</script>
@endsection
