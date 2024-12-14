@extends('layouts.dashboard')

@section('content')

@include('components.alert')

<style>
    /* Solid border */
    hr.solid {
        border-top: 5px solid #000000;
    }
</style>

<a href="{{ route('dashboard.orders.index') }}" class="btn btn-secondary mb-3">Back to Orders</a>

<div class="card shadow p-4">
    <h2 class="mb-4">Add New Order</h2>
    <hr class="solid">

    <form action="{{ route('dashboard.orders.store') }}" method="POST">
        @csrf

        <!-- Customer Details -->
        <div class="form-group mb-3">
            <label for="customer_name" class="form-label fw-bold">Customer Name</label>
            <input type="text" name="customer_name" class="form-control" id="customer_name"
                value="{{ old('customer_name') }}" required>
            @error('customer_name')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>

        <div class="form-group mb-3">
            <label for="email" class="form-label fw-bold">Email</label>
            <input type="email" name="email" class="form-control" id="email" value="{{ old('email') }}" required>
            @error('email')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>

        <div class="form-group mb-3">
            <label for="phone" class="form-label fw-bold">Phone</label>
            <input type="text" name="phone" class="form-control" id="phone" value="{{ old('phone') }}" required>
            @error('phone')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>

        <hr class="solid">

        <div class="form-group mb-3">
            <label for="status" class="form-label fw-bold">Status</label>
            <select name="status" class="form-control" id="status" required>
                <option value="pending" {{ old('status') == 'pending' ? 'selected' : '' }}>Pending</option>
                <option value="completed" {{ old('status') == 'completed' ? 'selected' : '' }}>Completed</option>
                <option value="cancelled" {{ old('status') == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
            </select>
            @error('status')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>

        <!-- Payment Method -->
        <div class="form-group mb-3">
            <label for="payment_method" class="form-label fw-bold">Payment Method</label>
            <select name="payment_method" class="form-control" id="payment_method" required>
                <option value="credit_card" {{ old('payment_method') == 'credit_card' ? 'selected' : '' }}>Credit Card
                </option>
                <option value="paypal" {{ old('payment_method') == 'paypal' ? 'selected' : '' }}>Paypal</option>
                <option value="cash" {{ old('payment_method') == 'cash' ? 'selected' : '' }}>Cash</option>
            </select>
            @error('payment_method')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>

        <!-- Delivery Method -->
        <div class="form-group mb-3">
            <label for="delivery_method" class="form-label fw-bold">Delivery Method</label>
            <select name="delivery_method" class="form-control" id="delivery_method" required>
                <option value="pickup" {{ old('delivery_method') == 'pickup' ? 'selected' : '' }}>Pickup</option>
                <option value="delivery" {{ old('delivery_method') == 'delivery' ? 'selected' : '' }}>Delivery</option>
            </select>
            @error('delivery_method')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>

        <hr class="solid">

        <!-- Product Details as Cards -->
        <div id="product-list">
            <div class="card mb-4 shadow-sm product-entry">
                <div class="card-body">
                    <!-- Product Selection -->
                    <div class="mb-3">
                        <label class="form-label fw-bold">Product:</label>
                        <select name="products[0][product_id]" class="form-select product-select" required>
                            <option value="">Select a product</option>
                            @foreach($products as $product)
                                <option value="{{ $product->id }}" data-price="{{ $product->price }}">
                                    {{ $product->name }} (+₱{{ number_format($product->price, 2) }})
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Variation Selection -->
                    <div class="mb-3">
                        <label class="form-label fw-bold">Variation:</label>
                        <select name="products[0][variation_id]" class="form-select">
                            <option value="">No Variation</option>
                            @foreach($product->variations as $variation)
                                <option value="{{ $variation->id }}">
                                    {{ $variation->type }}: {{ $variation->value }} (+₱{{ number_format($variation->price, 2) }})
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Quantity -->
                    <div class="mb-3">
                        <label class="form-label fw-bold">Quantity:</label>
                        <input type="number" name="products[0][quantity]" class="form-control"
                            placeholder="Quantity" min="1" required>
                    </div>

                    <!-- Remove Button -->
                    <div class="text-end">
                        <button type="button" class="btn btn-danger remove-product">Remove</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Validation Errors -->
        @error('products.*.product_id')
            <span class="text-danger">{{ $message }}</span>
        @enderror
        @error('products.*.quantity')
            <span class="text-danger">{{ $message }}</span>
        @enderror

        <button type="button" id="add-product" class="btn btn-secondary mb-3">Add Product</button>

        <hr class="solid">

        <!-- Display Total Amount -->
        <div class="form-group mb-3">
            <label for="total_amount" class="form-label fw-bold">Total Amount</label>
            <input type="text" id="total_amount" class="form-control" readonly>
        </div>

        <button type="submit" class="btn btn-primary">Add Order</button>
    </form>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        // Add a new product entry
        document.getElementById('add-product').addEventListener('click', function () {
            var productEntry = document.querySelector('.product-entry').cloneNode(true);
            var productCount = document.querySelectorAll('.product-entry').length;

            // Update the name attributes to ensure unique indices
            productEntry.querySelector('.product-select').name = `products[${productCount}][product_id]`;
            productEntry.querySelector('input[type="number"]').name = `products[${productCount}][quantity]`;
            productEntry.querySelector('input[type="number"]').value = ''; // Reset the quantity input
            productEntry.querySelector('.product-select').value = ''; // Reset the product selection

            document.getElementById('product-list').appendChild(productEntry);
        });

        // Remove a product entry
        document.getElementById('product-list').addEventListener('click', function (e) {
            if (e.target.classList.contains('remove-product')) {
                e.target.closest('.product-entry').remove();
            }
        });
    });
</script>

@endsection
