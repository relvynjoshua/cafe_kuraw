@extends('layouts.dashboard')

@section('content')

@include('components.alert')
<a href="{{ route('dashboard.inventory.index') }}" class="btn btn-secondary">Back to Inventory</a>

<h1>Edit Inventory Item</h1>
<form action="{{ route('dashboard.inventory.update', $inventory->id) }}" method="POST">
    @csrf
    @method('PUT')
    <div class="form-group">
        <label for="item_name">Item Name</label>
        <input type="text" name="item_name" class="form-control" id="item_name" value="{{ $inventory->item_name }}" required>
        @error('item_name')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>

    <div class="form-group">
        <label for="supplier_id">Supplier</label>
        <select name="supplier_id" class="form-control" id="supplier_id" required>
            <option value="" disabled>Select a Supplier</option>
            @foreach ($suppliers as $supplier)
                <option value="{{ $supplier->id }}" {{ $inventory->supplier_id == $supplier->id ? 'selected' : '' }}>{{ $supplier->company_name }}</option>
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
            <option value="" disabled>Select a Category</option>
            @foreach ($categories as $category)
                <option value="{{ $category->id }}" {{ $inventory->category_id == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
            @endforeach
        </select>
        @error('category_id')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>

    <!-- Include other fields similar to Add Inventory Item Page -->

    <button type="submit" class="btn btn-primary">Update Item</button>
</form>
@endsection
