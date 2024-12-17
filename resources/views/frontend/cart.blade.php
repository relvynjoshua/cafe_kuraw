@extends('layouts.app')

@section('title', 'Cart')

@section('content')

<div class="container py-5">
    <h1 class="text-center mb-4"><i class="fas fa-shopping-cart"></i> My Cart</h1>

    <!-- Toggle Buttons -->
    <div class="text-center mb-4">
        <button data-toggle="cartSection" class="btn btn-primary">View Cart</button>
        <button data-toggle="orderHistorySection" class="btn btn-secondary">View Order History</button>
    </div>

    <!-- Cart Section -->
    <div id="cartSection" class="toggle-section">
        @if ($cart && count($cart) > 0)
            <!-- Cart Items Table -->
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
                                            <img src="{{ asset('storage/' . ($item['image'] ?? 'default.jpg')) }}" 
                                                 alt="{{ $item['name'] }}" 
                                                 class="img-thumbnail me-3" 
                                                 style="width: 60px; height: 60px;">
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
                                                   class="form-control form-control-sm w-auto d-inline">
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

            <!-- Order Summary -->
            <div class="card shadow-sm">
                <div class="card-header bg-secondary text-white">
                    <h4 class="mb-0">Order Summary</h4>
                </div>
                <div class="card-body text-center">
                    <h5>Total Price: ₱<span id="totalPrice">{{ number_format($totalPrice, 2) }}</span></h5>
                    <div class="mt-3">
                        <label for="discountInput" class="form-label">Apply Reward Points:</label>
                        <input type="number" id="discountInput" class="form-control d-inline w-25" 
                               min="0" max="{{ auth()->user()->reward_points }}" placeholder="Enter points">
                        <h5 class="text-danger mt-3">Discount Applied: ₱<span id="discountDisplay">{{ number_format($discount, 2) }}</span></h5>
                        <h5 class="text-success mt-3">Final Price: ₱<span id="finalPrice">{{ number_format($finalPrice, 2) }}</span></h5>
                    </div>
                    <p><strong>Available Reward Points:</strong> {{ auth()->user()->reward_points }}</p>

                    <!-- Checkout Form -->
                    <form action="{{ route('order.store') }}" method="POST" class="mt-3">
                        @csrf
                        <input type="hidden" name="applied_points" id="appliedPoints" value="0">
                        <input type="hidden" name="customer_name" value="{{ auth()->user()->firstname }}">
                        <input type="hidden" name="email" value="{{ auth()->user()->email }}">
                        <div class="mb-3">
                            <label for="phone" class="form-label">Phone</label>
                            <input type="text" name="phone" id="phone" class="form-control" placeholder="Enter your phone number" required>
                        </div>
                        <div class="mb-3">
                            <label for="payment_method" class="form-label">Payment Method</label>
                            <select name="payment_method" id="payment_method" class="form-select" required>
                                <option value="" disabled selected>Select a payment method</option>
                                <option value="credit_card">Credit Card</option>
                                <option value="paypal">Paypal</option>
                                <option value="cash">GCash</option>
                            </select>
                        </div>
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
                <p><a href="{{ route('menu') }}" class="btn btn-primary mt-3">Browse Menu</a></p>
            </div>
        @endif
    </div>

    <!-- Order History Section -->
    <div id="orderHistorySection" class="toggle-section d-none">
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
                                    <td><span class="badge bg-{{ $order->status === 'completed' ? 'success' : ($order->status === 'pending' ? 'warning' : 'danger') }}">{{ ucfirst($order->status) }}</span></td>
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
                <p><a href="{{ route('menu') }}" class="btn btn-primary mt-3">Start Shopping</a></p>
            </div>
        @endif
    </div>
</div>

<!-- JavaScript -->
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const toggleButtons = document.querySelectorAll('[data-toggle]');
        toggleButtons.forEach(button => {
            button.addEventListener('click', function () {
                const targetId = this.getAttribute('data-toggle');
                document.querySelectorAll('.toggle-section').forEach(section => section.classList.add('d-none'));
                document.getElementById(targetId).classList.remove('d-none');
                toggleButtons.forEach(btn => btn.classList.remove('btn-primary'));
                this.classList.add('btn-primary');
            });
        });

        const discountInput = document.getElementById('discountInput');
        const discountDisplay = document.getElementById('discountDisplay');
        const totalPrice = parseFloat(document.getElementById('totalPrice').textContent.replace(',', ''));
        const finalPrice = document.getElementById('finalPrice');
        discountInput.addEventListener('input', function () {
            const points = Math.min(parseInt(this.value, 10) || 0, {{ auth()->user()->reward_points }});
            discountDisplay.textContent = points.toFixed(2);
            finalPrice.textContent = (totalPrice - points).toFixed(2);
        });
    });
</script>

@endsection
