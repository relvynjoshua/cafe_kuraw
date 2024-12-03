@extends('layouts.dashboard')

@section('content')

@include('components.alert')

<a href="{{ route('dashboard.orders.index') }}" class="btn btn-secondary mb-3">Back to Orders</a>

<div class="card shadow p-4">
    <h2 class="mb-4">Order Details</h2>

    <div class="row">
        <div class="col-md-6">
            <p><strong>Customer Name:</strong> {{ $order->customer_name }}</p>
            <p><strong>Email:</strong> {{ $order->email }}</p>
            <p><strong>Phone:</strong> {{ $order->phone }}</p>
            <p><strong>Payment Method:</strong> {{ ucfirst($order->payment_method) }}</p>
        </div>
        <div class="col-md-6">
            <p><strong>Total Amount:</strong> ${{ number_format($order->total_amount, 2) }}</p>
            <p><strong>Order Status:</strong> {{ ucfirst($order->status) }}</p>
            <p><strong>Delivery Method:</strong> {{ ucfirst($order->delivery_method) }}</p>
        </div>
    </div>

    <!-- Products Section -->
    <h4 class="mt-4">Products in this Order</h4>
    <table class="table table-striped">
        <thead class="thead-dark">
            <tr>
                <th>Product Name</th>
                <th>Quantity</th>
                <th>Unit Price</th>
                <th>Total</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($order->products as $product)
                <tr>
                    <td>{{ $product->name }}</td>
                    <td>{{ $product->pivot->quantity }}</td>
                    <td>${{ number_format($product->price, 2) }}</td>
                    <td>${{ number_format($product->pivot->quantity * $product->price, 2) }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <!-- Action Buttons -->
    <div class="d-flex justify-content-between mt-4">
        <a href="{{ route('dashboard.orders.edit', $order->id) }}" class="btn btn-warning">Edit Order</a>
        <form action="{{ route('dashboard.orders.destroy', $order->id) }}" method="POST" style="display:inline;"
            onsubmit="return confirm('Are you sure you want to delete this order?');">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger">Delete Order</button>
        </form>
    </div>
</div>

@endsection