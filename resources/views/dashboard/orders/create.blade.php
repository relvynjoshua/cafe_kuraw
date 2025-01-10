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

    <form action="{{ route('dashboard.orders.store') }}" method="POST" enctype="multipart/form-data">
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
            <select name="payment_method" id="payment_method" class="form-control" required>
                <option value="cash">Cash</option>
                <option value="gcash">GCash</option>
            </select>
        </div>

        <!-- Cash Details -->
        <div id="cash_details" class="payment-details">
            <div class="form-group mb-3">
                <label for="cash_received" class="form-label fw-bold">Cash Received</label>
                <input type="number" name="cash_received" class="form-control" id="cash_received" min="0" step="0.01">
            </div>
            <div class="form-group mb-3">
                <label for="change" class="form-label fw-bold">Change</label>
                <input type="text" id="change" class="form-control" readonly>
            </div>
        </div>

        <!-- GCash Details -->
        <div id="gcash_details" class="payment-details d-none">
            <div class="form-group mb-3">
                <label for="reference_number" class="form-label fw-bold">Reference Number (for GCash)</label>
                <input type="text" name="reference_number" class="form-control" id="reference_number"
                    value="{{ old('reference_number') }}">
                @error('reference_number')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group mb-3">
                <label for="proof_of_payment" class="form-label fw-bold">Proof of Payment</label>
                <input type="file" name="proof_of_payment" class="form-control" id="proof_of_payment">
                @error('proof_of_payment')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
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

        <!-- Product Details -->
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
                    <div class="form-group mb-3 variation-container">
                        <label class="form-label fw-bold">Variation</label>
                        <select name="products[0][product_variation_id]" class="form-select variation-select">
                            <option value="">Select a variation</option>
                        </select>
                    </div>

                    <!-- Quantity -->
                    <div class="mb-3">
                        <label class="form-label fw-bold">Quantity:</label>
                        <input type="number" name="products[0][quantity]" class="form-control quantity-input"
                            placeholder="Quantity" min="1" required>
                    </div>

                    <!-- Remove Button -->
                    <div class="text-end">
                        <button type="button" class="btn btn-danger remove-product">Remove</button>
                    </div>
                </div>
            </div>
        </div>

        <button type="button" id="add-product" class="btn btn-secondary mb-3">Add Product</button>

        <hr class="solid">

        <!-- Display Total Amount -->
        <div class="form-group mb-3">
            <label for="total_amount" class="form-label fw-bold">Total Amount</label>
            <input type="text" name="total_amount" id="total_amount" class="form-control" readonly>
        </div>

        <input type="hidden" name="cart" id="cart">

        <button type="submit" class="btn btn-primary">Add Order</button>
    </form>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        // Function to calculate the total amount
        const calculateTotal = () => {
            let total = 0;
            let cartData = []; // Holds cart data for the hidden input field
            document.querySelectorAll('.product-entry').forEach((entry, index) => {
                const productSelect = entry.querySelector('.product-select');
                const variationSelect = entry.querySelector('.variation-select');
                const quantityInput = entry.querySelector('.quantity-input');

                const productId = productSelect.value;
                const variationId = variationSelect.value;
                const variationPrice = parseFloat(variationSelect.selectedOptions[0]?.dataset.price || 0);
                const basePrice = parseFloat(productSelect.selectedOptions[0]?.dataset.price || 0);
                const quantity = parseInt(quantityInput.value || 0);

                // Calculate price based on variation or base price
                const price = variationId ? variationPrice : basePrice;
                total += price * quantity;

                // Push product data to cartData array
                if (productId) {
                    cartData.push({
                        id: productId,
                        variation: variationId,
                        quantity: quantity,
                        price: price,
                    });
                }
            });

            document.getElementById('total_amount').value = total.toFixed(2);
            document.getElementById('cart').value = JSON.stringify(cartData); // Update cart input field

            calculateChange(); // Recalculate change
        };

        const calculateChange = () => {
            const totalAmount = parseFloat(document.getElementById('total_amount').value || 0);
            const cashReceived = parseFloat(document.getElementById('cash_received').value || 0);
            const change = cashReceived - totalAmount;
            document.getElementById('change').value = change >= 0 ? `₱${change.toFixed(2)}` : '₱0.00';
        };

        // Toggle Payment Details
        document.getElementById('payment_method').addEventListener('change', function () {
            const method = this.value;
            document.getElementById('cash_details').classList.toggle('d-none', method !== 'cash');
            document.getElementById('gcash_details').classList.toggle('d-none', method !== 'gcash');
        });

        // Add Product
        document.getElementById('add-product').addEventListener('click', function () {
            const productEntry = document.querySelector('.product-entry').cloneNode(true);
            const productCount = document.querySelectorAll('.product-entry').length;

            productEntry.querySelector('.product-select').name = `products[${productCount}][product_id]`;
            productEntry.querySelector('.quantity-input').name = `products[${productCount}][quantity]`;
            productEntry.querySelector('.variation-select').name = `products[${productCount}][product_variation_id]`;
            productEntry.querySelector('.quantity-input').value = '';
            productEntry.querySelector('.product-select').value = '';
            productEntry.querySelector('.variation-container').classList.add('d-none');

            document.getElementById('product-list').appendChild(productEntry);
            calculateTotal();
        });

        // Load Variations
        document.getElementById('product-list').addEventListener('change', async function (e) {
            if (e.target.classList.contains('product-select')) {
                const productEntry = e.target.closest('.product-entry');
                const productId = e.target.value;
                const variationSelect = productEntry.querySelector('.variation-select');
                const variationContainer = productEntry.querySelector('.variation-container');

                variationSelect.innerHTML = '<option value="">Loading variations...</option>';

                const response = await fetch(`/dashboard/orders/variations/${productId}`);
                const variations = await response.json();

                if (variations.length > 0) {
                    variationSelect.innerHTML = '<option value="">Select a variation</option>';
                    variations.forEach(variation => {
                        variationSelect.innerHTML += `<option value="${variation.product_variation_id}" data-price="${variation.price}">
                            ${variation.type} - ${variation.value} (+₱${variation.price})
                        </option>`;
                    });
                    variationContainer.classList.remove('d-none');
                } else {
                    variationContainer.classList.add('d-none');
                }
            }
            calculateTotal();
        });

        // Remove Product
        document.getElementById('product-list').addEventListener('click', function (e) {
            if (e.target.classList.contains('remove-product')) {
                e.target.closest('.product-entry').remove();
                calculateTotal();
            }
        });

        // Update Total and Change Dynamically
        document.getElementById('product-list').addEventListener('input', calculateTotal);
        document.getElementById('cash_received').addEventListener('input', calculateChange);
    });
</script>

@endsection