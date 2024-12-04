@extends('layouts.dashboard')

@section('content')

@include('components.alert')

<a href="{{ route('dashboard.orders.index') }}" class="btn btn-secondary mb-3">Back to Orders</a>

<div class="card shadow p-4">
    <h2 class="mb-4">Add New Order</h2>
    <form action="{{ route('dashboard.orders.store') }}" method="POST">
        @csrf

        <!-- Customer Details -->
        <div class="form-group mb-3">
            <label for="customer_name" class="form-label">Customer Name</label>
            <input type="text" name="customer_name" class="form-control" id="customer_name"
                value="{{ old('customer_name') }}" required>
            @error('customer_name')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>

        <div class="form-group mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" name="email" class="form-control" id="email" value="{{ old('email') }}" required>
            @error('email')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>

        <div class="form-group mb-3">
            <label for="phone" class="form-label">Phone</label>
            <input type="text" name="phone" class="form-control" id="phone" value="{{ old('phone') }}" required>
            @error('phone')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>

        <div class="form-group mb-3">
            <label for="status" class="form-label">Status</label>
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
            <label for="payment_method" class="form-label">Payment Method</label>
            <select name="payment_method" class="form-control" id="payment_method" required>
                <option value="credit_card" {{ old('payment_method') == 'credit_card' ? 'selected' : '' }}>Credit Card</option>
                <option value="paypal" {{ old('payment_method') == 'paypal' ? 'selected' : '' }}>Paypal</option>
                <option value="cash" {{ old('payment_method') == 'cash' ? 'selected' : '' }}>Cash</option>
            </select>
            @error('payment_method')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>

        <!-- Delivery Method -->
        <div class="form-group mb-3">
            <label for="delivery_method" class="form-label">Delivery Method</label>
            <select name="delivery_method" class="form-control" id="delivery_method" required>
                <option value="pickup" {{ old('delivery_method') == 'pickup' ? 'selected' : '' }}>Pickup</option>
                <option value="delivery" {{ old('delivery_method') == 'delivery' ? 'selected' : '' }}>Delivery</option>
            </select>
            @error('delivery_method')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>

        <!-- Product Selection -->
        <div id="product-list">
            @if(old('products'))
                @foreach(old('products') as $index => $product)
                    <div class="product-entry mb-3">
                        <select name="products[{{ $index }}][product_id]" class="form-control product-select" required>
                            <option value="">Select a product</option>
                            @foreach($products as $p)
                                <option value="{{ $p->id }}" {{ old("products.{$index}.product_id") == $p->id ? 'selected' : '' }}
                                    data-price="{{ $p->price }}">
                                    {{ $p->name }}
                                </option>
                            @endforeach
                        </select>
                        @error("products.{$index}.product_id")
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                        <input type="number" name="products[{{ $index }}][quantity]" class="form-control mt-2"
                            placeholder="Quantity" value="{{ old("products.{$index}.quantity") }}" min="1" required>
                        @error("products.{$index}.quantity")
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                @endforeach
            @else
                <div class="product-entry mb-3">
                    <select name="products[0][product_id]" class="form-control product-select" required>
                        <option value="">Select a product</option>
                        @foreach($products as $product)
                            <option value="{{ $product->id }}" data-price="{{ $product->price }}">{{ $product->name }}</option>
                        @endforeach
                    </select>
                    <input type="number" name="products[0][quantity]" class="form-control mt-2" placeholder="Quantity"
                        min="1" required>
                </div>
            @endif
        </div>

        <button type="button" id="add-product" class="btn btn-secondary mb-3">Add Product</button>

        <!-- Display Total Amount -->
        <div class="form-group mb-3">
            <label for="total_amount" class="form-label">Total Amount</label>
            <input type="text" id="total_amount" class="form-control" readonly>
        </div>

        <button type="submit" class="btn btn-primary">Add Order</button>
    </form>

    <script>
        document.getElementById('add-product').addEventListener('click', function () {
            var productEntry = document.querySelector('.product-entry').cloneNode(true);
            var productCount = document.querySelectorAll('.product-entry').length;

            // Update the name attributes to use unique indices
            productEntry.querySelector('.product-select').name = `products[${productCount}][product_id]`;
            productEntry.querySelector('.product-select').value = ''; // Reset the product selection
            productEntry.querySelector('input[type="number"]').name = `products[${productCount}][quantity]`;
            productEntry.querySelector('input[type="number"]').value = ''; // Reset the quantity input

            // Append the new product entry
            document.getElementById('product-list').appendChild(productEntry);

            // Recalculate the total amount
            updateTotalAmount();
        });

        // Update the total amount based on selected products and quantities
        function updateTotalAmount() {
            var totalAmount = 0;
            var productEntries = document.querySelectorAll('.product-entry');

            productEntries.forEach(function (entry) {
                var productSelect = entry.querySelector('.product-select');
                var quantityInput = entry.querySelector('input[type="number"]');

                // Only calculate if a valid product and quantity are selected
                if (productSelect.value && quantityInput.value) {
                    var price = parseFloat(productSelect.options[productSelect.selectedIndex]?.getAttribute('data-price') || 0);
                    var quantity = parseInt(quantityInput.value, 10);

                    if (!isNaN(price) && !isNaN(quantity)) {
                        totalAmount += price * quantity;
                    }
                }
            });

            // Set the calculated total amount
            document.getElementById('total_amount').value = totalAmount.toFixed(2);
        }

        // Event delegation: Listen for changes in the product list (on product or quantity change)
        document.getElementById('product-list').addEventListener('change', function (event) {
            if (event.target.matches('.product-select, input[type="number"]')) {
                updateTotalAmount();
            }
        });

        // Initialize total amount calculation on page load
        window.onload = function () {
            updateTotalAmount();
        };
    </script>

@endsection
