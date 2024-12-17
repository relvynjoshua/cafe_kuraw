@extends('layouts.app')

@section('title', 'My Orders')

@section('content')
<div class="container py-5">
    <h1 class="text-center mb-4"><i class="fas fa-box"></i> My Orders</h1>

    @if ($orders->isNotEmpty())
        <div class="space-y-4">
            @foreach ($orders as $order)
                <div class="border rounded-lg shadow p-4 hover:bg-gray-50 transition">
                    <a href="{{ route('orders.show', $order->id) }}" class="flex justify-between items-center text-decoration-none text-dark">
                        <div>
                            <h4 class="font-semibold">Order #{{ $order->id }}</h4>
                            <p class="text-sm text-gray-500">Date: {{ $order->created_at->format('F d, Y h:i A') }}</p>
                            <p class="text-sm">
                                Status:
                                <span class="badge bg-{{ $order->status === 'completed' ? 'success' : ($order->status === 'pending' ? 'warning' : 'danger') }}">
                                    {{ ucfirst($order->status) }}
                                </span>
                            </p>
                        </div>
                        <div class="text-lg font-bold">₱{{ number_format($order->total_amount, 2) }}</div>
                    </a>
                    @if ($order->isCancelable())
                        <form method="POST" action="{{ route('orders.cancel', $order->id) }}" class="mt-2">
                            @csrf
                            <button type="submit" class="btn btn-danger btn-sm">Cancel Order</button>
                        </form>
                    @endif
                </div>
            @endforeach
        </div>
    @else
        <div class="alert alert-warning text-center">
            <h4>No orders found.</h4>
            <p>You have not placed any orders yet. <a href="{{ route('menu') }}" class="text-primary">Start shopping</a>.</p>
        </div>
    @endif
</div>
@endsection
