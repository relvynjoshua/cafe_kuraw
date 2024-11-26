@extends('layouts.dashboard')

@section('content')

@include('components.alert')

<div class="d-flex justify-content-between align-items-center mb-4">
    <h1>Orders</h1>
    <a href="{{ route('dashboard.orders.create') }}" class="btn btn-primary">Add Order</a>
</div>

<div class="card shadow">
    <div class="card-body">
        <table class="table table-striped">
            <thead class="thead-dark">
                <tr>
                    <th>ID</th>
                    <th>Customer Name</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Total Amount</th>
                    <th>Status</th>
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
                        <td>{{ ucfirst($order->status) }}</td>
                        <td>
                            <a href="{{ route('dashboard.orders.edit', $order->id) }}" class="btn btn-warning btn-sm">Edit</a>
                            <form action="{{ route('dashboard.orders.destroy', $order->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="text-center">No orders found.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

@endsection
