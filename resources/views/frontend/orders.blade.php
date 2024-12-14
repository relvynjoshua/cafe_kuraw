@extends('layouts.app')

@section('title', 'My Orders')

@section('content')
<div class="container py-5">
    <h1 class="text-center mb-4"><i class="fas fa-box"></i> My Orders</h1>

    @if ($orders->isNotEmpty())
        <div class="card shadow-sm">
            <div class="card-header bg-dark text-white">
                <h4>Order History</h4>
            </div>
            <div class="card-body">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Order ID</th>
                            <th>Date</th>
                            <th>Status</th>
                            <th>Total</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($orders as $order)
                            <tr>
                                <td>{{ $order->id }}</td>
                                <td>{{ $order->created_at->format('Y-m-d H:i') }}</td>
                                <td>
                                    <span class="badge bg-{{ $order->status === 'completed' ? 'success' : ($order->status === 'pending' ? 'warning' : 'danger') }}">
                                        {{ ucfirst($order->status) }}
                                    </span>
                                </td>
                                <td>₱{{ number_format($order->total_amount, 2) }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    @else
        <div class="alert alert-warning text-center">
            <h4>No orders found.</h4>
            <p>You have not placed any orders yet. <a href="{{ route('menu') }}" class="text-primary">Start shopping</a>.</p>
        </div>
    @endif
</div>
@endsection
