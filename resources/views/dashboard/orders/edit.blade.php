@extends('layouts.dashboard')

@section('content')

@include('components.alert')

<a href="{{ route('dashboard.orders.index') }}" class="btn btn-secondary mb-3">Back to Orders</a>

<div class="card shadow p-4">
    <h2 class="mb-4">Edit Order</h2>
    <form action="{{ route('dashboard.orders.update', $order->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="form-group mb-3">
            <label for="customer_name" class="form-label">Customer Name</label>
            <input type="text" name="customer_name" class="form-control" id="customer_name" value="{{ $order->customer_name }}" required>
            @error('customer_name')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>

        <div class="form-group mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" name="email" class="form-control" id="email" value="{{ $order->email }}" required>
            @error('email')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>

        <div class="form-group mb-3">
            <label for="phone" class="form-label">Phone</label>
            <input type="text" name="phone" class="form-control" id="phone" value="{{ $order->phone }}" required>
            @error('phone')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>

        <div class="form-group mb-3">
            <label for="total_amount" class="form-label">Total Amount</label>
            <input type="number" step="0.01" name="total_amount" class="form-control" id="total_amount" value="{{ $order->total_amount }}" required>
            @error('total_amount')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>

        <div class="form-group mb-3">
            <label for="status" class="form-label">Status</label>
            <select name="status" class="form-control" id="status" required>
                <option value="pending" @if($order->status == 'pending') selected @endif>Pending</option>
                <option value="completed" @if($order->status == 'completed') selected @endif>Completed</option>
                <option value="cancelled" @if($order->status == 'cancelled') selected @endif>Cancelled</option>
            </select>
            @error('status')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>

        <button type="submit" class="btn btn-primary">Update Order</button>
    </form>
</div>

@endsection
