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
    <h2 class="mb-4">Add Inventory Item</h2>
    <hr class="solid">

    <form action="{{ route('dashboard.inventory.store') }}" method="POST">
        @csrf
        <div class="form-group mb-3">
            <label for="item_name" class="form-label fw-bold">Item Name</label>
            <input type="text" name="item_name" class="form-control" id="item_name" required>
            @error('item_name')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>

        <div class="form-group mb-3">
            <label for="quantity" class="form-label fw-bold">Quantity</label>
            <input type="number" name="quantity" class="form-control" id="quantity" required>
            @error('quantity')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>

        <div class="form-group mb-3">
            <label for="unit" class="form-label fw-bold">Unit</label>
            <input type="text" name="unit" class="form-control" id="unit" required>
            @error('unit')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>

        <div class="form-group mb-3">
            <label for="price" class="form-label fw-bold">Price</label>
            <input type="number" step="0.01" name="price" class="form-control" id="price" required>
            @error('price')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>

        <div class="form-group mb-3">
            <label for="expiry_date" class="form-label fw-bold">Expiry Date</label>
            <input type="date" name="expiry_date" class="form-control" id="expiry_date">
            @error('expiry_date')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>

        <div class="form-group mb-3">
            <label for="supplier_id" class="form-label fw-bold">Supplier</label>
            <select name="supplier_id" class="form-control" id="supplier_id" required>
                <option value="" disabled selected>Select a Supplier</option>
                @foreach ($suppliers as $supplier)
                    <option value="{{ $supplier->id }}">{{ $supplier->company_name }}</option>
                @endforeach
            </select>
            @error('supplier_id')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>

        <div class="form-group mb-3">
            <label for="category_id" class="form-label fw-bold">Category</label>
            <select name="category_id" class="form-control" id="category_id" required>
                <option value="" disabled selected>Select a Category</option>
                @foreach ($categories as $category)
                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                @endforeach
            </select>
            @error('category_id')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>

        <div class="form-group mb-3">
            <label for="location" class="form-label fw-bold">Location</label>
            <input type="text" name="location" class="form-control" id="location">
            @error('location')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>

        <div class="form-group mb-3">
            <label for="description" class="form-label fw-bold">Description</label>
            <textarea name="description" class="form-control" id="description"></textarea>
            @error('description')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>

        <button type="submit" class="btn btn-primary">Add Item</button>
    </form>
</div>

@endsection
