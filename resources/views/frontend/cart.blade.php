@extends('layouts.app')

@section('title', 'Cart')

@section('content')

<div class="container py-5">
    <h1 class="text-center mb-4"><i class="fas fa-shopping-cart"></i> My Cart</h1>

    <div class="text-center mb-4">
        <!-- Toggle Buttons -->
        <button id="cartTab" class="btn btn-primary">View Cart</button>
        <button id="orderHistoryTab" class="btn btn-secondary">View Order History</button>
    </div>

    <!-- Cart Section -->
    <div id="cartSection">
        @if ($cart && count($cart) > 0)
            <!-- Table Section -->
            <div class="card shadow-sm mb-4">
                <div class="card-header bg-dark">
                    <h4 class="mb-0 text-white">Your Cart Items</h4>
                </div>
                <div class="card-body">
                    <table class="table table-responsive-md">
                        <thead class="table-light">
                            <tr>
                                <th>Product</th>
                                <th>Price</th>
                                <th>Quantity</th>
                                <th>Total</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($cart as $id => $item)
                                <tr>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <div class="cart-item-image">
                                                <img src="{{ asset('storage/' . ($item['image'] ?? 'default.jpg')) }}"
                                                    alt="{{ $item['name'] }}" class="img-thumbnail me-3"
                                                    style="width: 60px; height: 60px;">
                                            </div>
                                            <div>
                                                <p class="mb-0 fw-bold">{{ $item['name'] }}</p>
                                                @if (!empty($item['variation']))
                                                    <small class="text-muted">Variation: {{ $item['variation'] }}</small>
                                                @endif
                                            </div>
                                        </div>
                                    </td>
                                    <td>₱{{ number_format($item['price'], 2) }}</td>
                                    <td>
                                        <form action="{{ route('cart.update') }}" method="POST" class="d-inline">
                                            @csrf
                                            <input type="hidden" name="item_id" value="{{ $id }}">
                                            <input type="number" name="quantity" value="{{ $item['quantity'] }}" min="1"
                                                class="form-control form-control-sm d-inline w-auto">
                                            <button type="submit" class="btn btn-sm btn-primary mt-1">Update</button>
                                        </form>
                                    </td>
                                    <td>₱{{ number_format($item['price'] * $item['quantity'], 2) }}</td>
                                    <td>
                                        <form action="{{ route('cart.remove') }}" method="POST" class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <input type="hidden" name="item_id" value="{{ $id }}">
                                            <button type="submit" class="btn btn-sm btn-danger">
                                                <i class="fas fa-trash"></i> Remove
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Total Price Section -->
            <!-- Total Price Section -->
        <div class="card shadow-sm">
            <div class="card-header bg-secondary text-white">
                <h4 class="mb-0 text-white">Order Summary</h4>
            </div>
            <div class="card-body">
                <!-- Total and Discount Section -->
                <h5 class="text-center">Total Price: ₱<span id="totalPrice">{{ number_format($totalPrice, 2) }}</span></h5>
                <div class="text-center mt-3">
                    <label for="discountInput" class="form-label me-2">Apply Reward Points:</label>
                    <input type="number" id="discountInput" class="form-control d-inline w-25" 
                        min="0" max="{{ auth()->user()->reward_points }}" placeholder="Enter points">
                    <h5 class="text-danger mt-3">Discount Applied: ₱<span id="discountDisplay">{{ number_format($discount, 2) }}</span></h5>
                    <h5 class="text-success mt-3">Final Price: ₱<span id="finalPrice">{{ number_format($finalPrice, 2) }}</span></h5>
                </div>

                <!-- Reward Points Information -->
                <div class="text-center mt-3">
                    <p><strong>Available Reward Points:</strong> {{ auth()->user()->reward_points }}</p>
                </div>

                <!-- Checkout Form -->
                <form action="{{ route('order.store') }}" method="POST" class="mt-3">
                    @csrf
                    <input type="hidden" name="applied_points" id="appliedPoints" value="0"> <!-- Hidden field for applied points -->
                    <div class="mb-3">
                        <label for="customer_name" class="form-label">Name</label>
                        <input type="text" name="customer_name" id="customer_name" class="form-control"
                            value="{{ auth()->user()->firstname }}" readonly>
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" name="email" id="email" class="form-control" value="{{ auth()->user()->email }}"
                            readonly>
                    </div>
                    <div class="mb-3">
                        <label for="phone" class="form-label">Phone</label>
                        <input type="text" name="phone" id="phone" class="form-control"
                            placeholder="Enter your phone number" required>
                    </div>
                    <!-- Payment Method -->
                    <div class="mb-3">
                        <label for="payment_method" class="form-label">Payment Method</label>
                        <select name="payment_method" id="payment_method" class="form-select" required>
                            <option value="" disabled selected>Select a payment method</option>
                            <option value="credit_card">Credit Card</option>
                            <option value="paypal">Paypal</option>
                            <option value="cash">Cash</option>
                        </select>
                    </div>
                    <!-- Delivery Method -->
                    <div class="mb-3">
                        <label for="delivery_method" class="form-label">Delivery Method</label>
                        <select name="delivery_method" id="delivery_method" class="form-select" required>
                            <option value="" disabled selected>Select a delivery method</option>
                            <option value="pickup">Pick-Up</option>
                            <option value="delivery">Delivery</option>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-success w-100">Place Order</button>
                </form>
            </div>
        </div>
        @else
            <div class="alert alert-warning text-center">
                <h4>Your cart is empty.</h4>
                <p>Go back to the <a href="{{ route('menu') }}" class="text-primary">menu</a> to add products to your cart.</p>
            </div>
        @endif
    </div>

    <!-- Order History Section -->
    <div id="orderHistorySection" class="d-none">
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
</div>

<!-- Add Custom JavaScript -->
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const cartTab = document.getElementById('cartTab');
        const orderHistoryTab = document.getElementById('orderHistoryTab');
        const cartSection = document.getElementById('cartSection');
        const orderHistorySection = document.getElementById('orderHistorySection');

        cartTab.addEventListener('click', () => {
            cartSection.classList.remove('d-none');
            orderHistorySection.classList.add('d-none');
            cartTab.classList.add('btn-primary');
            cartTab.classList.remove('btn-secondary');
            orderHistoryTab.classList.add('btn-secondary');
            orderHistoryTab.classList.remove('btn-primary');
        });

        orderHistoryTab.addEventListener('click', () => {
            orderHistorySection.classList.remove('d-none');
            cartSection.classList.add('d-none');
            orderHistoryTab.classList.add('btn-primary');
            orderHistoryTab.classList.remove('btn-secondary');
            cartTab.classList.add('btn-secondary');
            cartTab.classList.remove('btn-primary');
        });
    });
</script>

@endsection
