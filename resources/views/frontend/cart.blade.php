@extends('layouts.app')

@section('title', 'Cart')

@section('content')

<div class="container py-5">
    <h1 class="text-center mb-4"><i class="fas fa-shopping-cart"></i> My Cart</h1>

    @if ($cart)
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
                                <!-- Product and Variation -->
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
                                <!-- Price -->
                                <td>₱{{ number_format($item['price'], 2) }}</td>
                                <!-- Quantity -->
                                <td>
                                    <form action="{{ route('cart.update') }}" method="POST" class="d-inline">
                                        @csrf
                                        <input type="hidden" name="item_id" value="{{ $id }}">
                                        <input type="number" name="quantity" value="{{ $item['quantity'] }}" min="1"
                                            class="form-control form-control-sm d-inline w-auto">
                                        <button type="submit" class="btn btn-sm btn-primary mt-1">Update</button>
                                    </form>
                                </td>
                                <!-- Total -->
                                <td>₱{{ number_format($item['price'] * $item['quantity'], 2) }}</td>
                                <!-- Actions -->
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
        <div class="card shadow-sm">
            <div class="card-header bg-secondary text-white">
                <h4 class="mb-0 text-white">Order Summary</h4>
            </div>
            <div class="card-body">
                <h5 class="text-center text-success bg-light">Overall Total:
                    ₱{{ number_format(collect($cart)->sum(fn($item) => $item['price'] * $item['quantity']), 2) }}</h5>
                <form action="{{ route('order.store') }}" method="POST" class="mt-3">
                    @csrf
                    <div class="mb-3">
                        <label for="customer_name" class="form-label">Name</label>
                        <input type="text" name="customer_name" id="customer_name" class="form-control"
                            placeholder="Enter your name" required>
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" name="email" id="email" class="form-control" placeholder="Enter your email"
                            required>
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

<!-- Add Custom CSS -->
<style>
    .cart-item-image img {
        border-radius: 0.5rem;
        object-fit: cover;
    }

    .modal-backdrop {
        z-index: 1040 !important;
    }

    .modal {
        z-index: 1050 !important;
    }
</style>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        @if (session('success') && session('order'))
            // Trigger the modal when the page loads and a success message exists
            const orderSuccessModal = new bootstrap.Modal(document.getElementById('orderSuccessModal'));
            orderSuccessModal.show();
        @endif
    });
</script>

<!-- Success Modal -->
<div class="modal fade" id="orderSuccessModal" tabindex="-1" aria-labelledby="orderSuccessModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content shadow-lg">
            <div class="modal-header bg-success text-white">
                <h5 class="modal-title" id="orderSuccessModalLabel"><i class="fas fa-check-circle"></i> Order Placed
                    Successfully!</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body text-center">
                <p>Your order has been successfully placed! Thank you for shopping with us.</p>
                <p><strong>Order Summary:</strong></p>
                <ul class="list-group">
                    <li class="list-group-item"><strong>Customer Name:</strong> {{ session('order.customer_name') }}
                    </li>
                    <li class="list-group-item"><strong>Email:</strong> {{ session('order.email') }}</li>
                    <li class="list-group-item"><strong>Phone:</strong> {{ session('order.phone') }}</li>
                    <li class="list-group-item"><strong>Total:</strong> ₱{{ session('order.total') }}</li>
                    <li class="list-group-item"><strong>Payment Method:</strong> {{ session('order.payment_method') }}
                    </li>
                    <li class="list-group-item"><strong>Delivery Method:</strong> {{ session('order.delivery_method') }}
                    </li>
                </ul>
            </div>
            <div class="modal-footer justify-content-center">
                <a href="{{ route('menu') }}" class="btn btn-primary"><i class="fas fa-utensils"></i> Continue
                    Shopping</a>
            </div>
        </div>
    </div>
</div>

@endsection