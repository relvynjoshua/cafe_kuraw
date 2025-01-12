@extends('layouts.dashboard')

@section('content')

@include('components.alert')
<style>
    /* Solid border */
    hr.solid {
        border-top: 5px solid #000000;
    }
</style>

<a href="{{ route('dashboard.inventory.index') }}" class="btn btn-secondary mb-3">Back to Inventory</a>

<div class="card shadow p-4">
    <h2 class="mb-4">Edit Inventory Item</h2>
    <hr class="solid">

    <form action="{{ route('dashboard.inventory.update', $inventory->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="form-group mb-3">
            <label for="item_name" class="form-label fw-bold">Item Name</label>
            <input type="text" name="item_name" class="form-control" id="item_name" value="{{ $inventory->item_name }}"
                required>
            @error('item_name')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>

        <div class="form-group mb-3">
        <label for="quantity" class="form-label fw-bold">Quantity</label>
        <input 
            type="number" 
            name="quantity" 
            class="form-control" 
            id="quantity" 
            value="{{ $inventory->quantity }}" 
            required 
            oninput="validateQuantity(this)"
        >
        <span id="quantityError" class="text-danger d-none">Quantity cannot be negative.</span>
        @error('quantity')
            <span class="text-danger">{{ $message }}</span>
        @enderror
    </div>


        <div class="form-group mb-3">
            <label for="unit" class="form-label fw-bold">Unit</label>
            <input type="text" name="unit" class="form-control" id="unit" value="{{ $inventory->unit }}" required>
            @error('unit')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>

        <div class="form-group mb-3">
        <label for="price" class="form-label fw-bold">Price</label>
        <input 
            type="number" 
            step="0.01" 
            name="price" 
            class="form-control" 
            id="price" 
            value="{{ $inventory->price }}" 
            required 
            oninput="validatePrice(this)"
        >
        <span id="priceError" class="text-danger d-none">Price must be greater than zero.</span>
        @error('price')
            <span class="text-danger">{{ $message }}</span>
        @enderror
    </div>

        <div class="form-group mb-3">
            <label for="expiry_date" class="form-label fw-bold">Expiry Date</label>
            <input type="date" name="expiry_date" class="form-control" id="expiry_date"
                value="{{ $inventory->expiry_date }}">
            @error('expiry_date')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>

        <div class="form-group mb-3">
            <label for="supplier_id" class="form-label fw-bold">Supplier</label>
            <select name="supplier_id" class="form-control" id="supplier_id" required>
                <option value="" disabled>Select a Supplier</option>
                @foreach ($suppliers as $supplier)
                    <option value="{{ $supplier->id }}" {{ $inventory->supplier_id == $supplier->id ? 'selected' : '' }}>
                        {{ $supplier->company_name }}
                    </option>
                @endforeach
            </select>
            @error('supplier_id')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>

        <div class="form-group mb-3">
            <label for="category_id" class="form-label fw-bold">Category</label>
            <select name="category_id" class="form-control" id="category_id" required>
                <option value="" disabled>Select a Category</option>
                @foreach ($categories as $category)
                    <option value="{{ $category->id }}" {{ $inventory->category_id == $category->id ? 'selected' : '' }}>
                        {{ $category->name }}
                    </option>
                @endforeach
            </select>
            @error('category_id')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>

        <div class="form-group mb-3">
            <label for="location" class="form-label fw-bold">Location</label>
            <input type="text" name="location" class="form-control" id="location" value="{{ $inventory->location }}">
            @error('location')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>

        <div class="form-group mb-3">
            <label for="description" class="form-label fw-bold">Description</label>
            <textarea name="description" class="form-control" id="description">{{ $inventory->description }}</textarea>
            @error('description')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>

        <div>
            <label>
                <input type="checkbox" name="is_expirable" id="is_expirable" onchange="toggleExpiryDate()" {{ old('is_expirable', $item->is_expirable ?? false) ? 'checked' : '' }}>
                Has Expiry Date
            </label>
            <input type="date" name="expiry_date" id="expiry_date" {{ old('is_expirable', $inventory->is_expirable ?? false) ? '' : 'disabled' }} value="{{ old('expiry_date', $inventory->expiry_date ?? '') }}">
        </div>

        <div>
            <label for="low_stock_threshold">Low Stock Threshold</label>
            <input type="number" name="low_stock_threshold"
                value="{{ old('low_stock_threshold', $inventory->low_stock_threshold ?? 5) }}">
        </div>

        <script>
            function toggleExpiryDate() {
                document.getElementById('expiry_date').disabled = !document.getElementById('is_expirable').checked;
            }

            function validateNonNegative(input) {
                if (input.value < 0) {
                    input.value = 0; // Set to 0 if negative
                }
            }

            function validatePrice(input) {
                const priceError = document.getElementById('priceError');
                if (input.value <= 0) {
                    priceError.classList.remove('d-none');
                    input.value = ''; // Clear invalid value
                } else {
                    priceError.classList.add('d-none');
                }
            }

            function validateQuantity(input) {
                const quantityError = document.getElementById('quantityError');
                if (input.value < 0) {
                    quantityError.classList.remove('d-none');
                    input.value = ''; // Clear invalid value
                } else {
                    quantityError.classList.add('d-none');
                }
            }
        </script>


        <button type="submit" class="btn btn-primary">Update Item</button>
    </form>
</div>

@endsection