@extends('layouts.dashboard')

@section('content')

@include('components.alert')

<a href="{{ route('dashboard.products.index') }}" class="btn btn-secondary mb-3">Back to Products</a>

<div class="card shadow p-4">
    <h2 class="mb-4">Edit Product</h2>
    <form action="{{ route('dashboard.products.update', ['id' => $product->id]) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="form-group mb-3">
            <label for="name" class="form-label">Product Name</label>
            <input type="text" name="name" class="form-control" id="name" value="{{ $product->name }}" required>
            @error('name')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>

        <div class="form-group mb-3">
            <label for="category_id" class="form-label">Category</label>
            <select name="category_id" class="form-control" required>
                <option value="" disabled>Select a Category</option>
                @foreach($categories as $category)
                    <option value="{{ $category->id }}" @if($product->category_id == $category->id) selected @endif>
                        {{ $category->name }}
                    </option>
                @endforeach
            </select>
            @error('category_id')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>

        <div class="form-group mb-3">
            <label for="price" class="form-label">Price</label>
            <input type="text" name="price" class="form-control" id="price" value="{{ $product->price }}" required>
            @error('price')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>

        <div class="form-group mb-3">
            <label for="description" class="form-label">Description</label>
            <textarea name="description" class="form-control" id="description" required>{{ $product->description }}</textarea>
            @error('description')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>

        <button type="submit" class="btn btn-primary">Update Product</button>
    </form>
</div>

@endsection
