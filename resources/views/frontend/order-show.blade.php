@extends('layouts.app')

@section('title', 'Order Details')

@section('content')
<div class="container py-5">
    <div class="p-4 border rounded-lg shadow">
        <h2 class="font-bold text-lg mb-2">Order Details</h2>
        <p><strong>Order ID:</strong> {{ $order->id }}</p>
        <p><strong>Date:</strong> {{ $order->created_at->format('F d, Y h:i A') }}</p>
        <p><strong>Status:</strong>
            <span class="badge bg-{{ $order->status === 'completed' ? 'success' : ($order->status === 'pending' ? 'warning' : 'danger') }}">
                {{ ucfirst($order->status) }}
            </span>
        </p>
        <p><strong>Total Amount:</strong> ₱{{ number_format($order->total_amount, 2) }}</p>
        <p><strong>Discount Applied:</strong> ₱{{ number_format($order->discount ?? 0, 2) }}</p>

        <h4 class="mt-4 font-semibold">Order Items</h4>
        <ul class="list-disc ml-6">
            @foreach ($order->products as $product)
                <li>
                    {{ $product->name }} - {{ $product->pivot->quantity }} x 
                    ₱{{ number_format($product->pivot->price, 2) }} 
                    @if ($product->pivot->variation)
                        ({{ $product->pivot->variation }})
                    @endif
                </li>
            @endforeach
        </ul>

        @if ($order->isCancelable())
            <form method="POST" action="{{ route('orders.cancelOrder', $order->id) }}" class="mt-4">
                @csrf
                <button type="submit" class="btn btn-danger">Cancel Order</button>
            </form>
        @endif
    </div>

    <a href="{{ route('orders.index') }}" class="btn btn-dark mt-4">Back to Orders</a>
</div>
@endsection
