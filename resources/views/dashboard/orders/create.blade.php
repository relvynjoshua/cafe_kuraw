@extends('layouts.dashboard')

@section('content')

@include('components.alert')

<a href="{{ route('dashboard.orders.index') }}" class="btn btn-secondary mb-3">Back to Orders</a>

<div class="card shadow p-4">
    <h2 class="mb-4">Add Order</h2>
    <form action="{{ route('dashboard.orders.store') }}" method="POST">
        @csrf

        <div class="form-group mb-3">
            <label for="customer_name" class="form-label">Customer Name</label>
            <input type="text" name="customer_name" class="form-control" id="customer_name" required>
            @error('customer_name')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>

        <div class="form-group mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" name="email" class="form-control" id="email" required>
            @error('email')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>

        <div class="form-group mb-3">
            <label for="phone" class="form-label">Phone</label>
            <input type="text" name="phone" class="form-control" id="phone" required>
            @error('phone')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>

        <div class="form-group mb-3">
            <label for="total_amount" class="form-label">Total Amount</label>
            <input type="number" step="0.01" name="total_amount" class="form-control" id="total_amount" required>
            @error('total_amount')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>

        <div class="form-group mb-3">
            <label for="status" class="form-label">Status</label>
            <select name="status" class="form-control" id="status" required>
                <option value="pending">Pending</option>
                <option value="completed">Completed</option>
                <option value="cancelled">Cancelled</option>
            </select>
            @error('status')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>

        <button type="submit" class="btn btn-primary">Add Order</button>
    </form>
</div>

@endsection
