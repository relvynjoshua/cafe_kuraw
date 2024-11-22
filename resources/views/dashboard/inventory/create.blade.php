@extends('layouts.dashboard')

@section('content')

@include('components.alert')
<a href="{{ route('dashboard.inventory.index') }}" class="btn btn-secondary">Back to Inventory</a>

<h1>Add Inventory Item</h1>
<form action="{{ route('dashboard.inventory.store') }}" method="POST">
    @csrf
    <div class="form-group">
        <label for="item_name">Item Name</label>
        <input type="text" name="item_name" class="form-control" id="item_name" required>
        @error('item_name')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>

    <div class="form-group">
        <label for="quantity">Quantity</label>
        <input type="number" name="quantity" class="form-control" id="quantity" required>
        @error('quantity')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>

    <div class="form-group">
        <label for="unit">Unit</label>
        <input type="text" name="unit" class="form-control" id="unit" required>
        @error('unit')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>

    <div class="form-group">
        <label for="price">Price</label>
        <input type="number" step="0.01" name="price" class="form-control" id="price" required>
        @error('price')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>

    <div class="form-group">
        <label for="expiry_date">Expiry Date</label>
        <input type="date" name="expiry_date" class="form-control" id="expiry_date">
        @error('expiry_date')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>

    <div class="form-group">
        <label for="supplier_id">Supplier</label>
        <select name="supplier_id" class="form-control" id="supplier_id" required>
            <option value="" disabled selected>Select a Supplier</option>
            @foreach ($suppliers as $supplier)
                <option value="{{ $supplier->id }}">{{ $supplier->company_name }}</option>
            @endforeach
        </select>
        @error('supplier_id')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>

    <div class="form-group">
        <label for="category_id">Category</label>
        <select name="category_id" class="form-control" id="category_id" required>
            <option value="" disabled selected>Select a Category</option>
            @foreach ($categories as $category)
                <option value="{{ $category->id }}">{{ $category->name }}</option>
            @endforeach
        </select>
        @error('category_id')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>

    <div class="form-group">
        <label for="location">Location</label>
        <input type="text" name="location" class="form-control" id="location">
        @error('location')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>

    <div class="form-group">
        <label for="description">Description</label>
        <textarea name="description" class="form-control" id="description"></textarea>
        @error('description')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>

    <button type="submit" class="btn btn-primary">Add Item</button>
</form>
@endsection
