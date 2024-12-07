@extends('layouts.dashboard')

@section('content')

@include('components.alert')

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
                                    <span class="badge 
                                    {{ $order->status == 'pending' ? 'bg-warning' :
                    ($order->status == 'completed' ? 'bg-success' :
                        ($order->status == 'cancelled' ? 'bg-danger' : '')) }}">
                                        {{ ucfirst($order->status) }}
                                    </span>
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