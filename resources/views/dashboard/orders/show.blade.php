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
        </div>
        <div class="col-md-6">
            <p><strong>Total Amount:</strong> ${{ number_format($order->total_amount, 2) }}</p>
            <p><strong>Status:</strong> {{ ucfirst($order->status) }}</p>
        </div>
    </div>
</div>

@endsection
