@extends('layouts.dashboard')

@section('content')

@include('components.alert')

<a href="{{ route('dashboard.products.index') }}" class="btn btn-secondary mb-3">Back to Products</a>

<div class="card shadow p-4">
    <h2 class="mb-4">Add Product</h2>
    <form action="{{ route('dashboard.products.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="form-group mb-3">
            <label for="name" class="form-label">Product Name</label>
            <input type="text" name="name" class="form-control" id="name" required>
            @error('name')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>

        <div class="form-group mb-3">
            <label for="category_id" class="form-label">Category</label>
            <select name="category_id" class="form-control" required>
                <option value="" disabled selected>Select a Category</option>
                @foreach($categories as $category)
                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                @endforeach
            </select>
            @error('category_id')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>

        <div class="form-group mb-3">
            <label for="price" class="form-label">Base Price</label>
            <input type="text" name="price" class="form-control" id="price" required>
            @error('price')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>

        <div class="form-group mb-3">
            <label for="description" class="form-label">Description</label>
            <textarea name="description" class="form-control" id="description" required></textarea>
            @error('description')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>

        <div class="form-group mb-3">
            <label for="image" class="form-label">Product Image</label>
            <input type="file" name="image" id="image" class="form-control">
            @error('image')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>

        <!-- Product Variations -->
        <div id="variations-container">
            <h4 class="mt-4">Product Variations</h4>
            <div class="variation-row row mb-3">
                <div class="col-md-4">
                    <input type="text" name="variations[0][type]" class="form-control" placeholder="Variation Type (e.g., Size)" required>
                </div>
                <div class="col-md-4">
                    <input type="text" name="variations[0][value]" class="form-control" placeholder="Variation Value (e.g., Medium)" required>
                </div>
                <div class="col-md-4">
                    <input type="text" name="variations[0][price]" class="form-control" placeholder="Additional Price (e.g., 20.00)" required>
                </div>
            </div>
        </div>
        <button type="button" class="btn btn-secondary" id="add-variation-btn">Add Variation</button>

        <button type="submit" class="btn btn-primary">Add Product</button>
    </form>
</div>

<script>
    let variationIndex = 1;

    document.getElementById('add-variation-btn').addEventListener('click', function() {
        const container = document.getElementById('variations-container');
        const row = document.createElement('div');
        row.classList.add('variation-row', 'row', 'mb-3');

        row.innerHTML = `
            <div class="col-md-4">
                <input type="text" name="variations[${variationIndex}][type]" class="form-control" placeholder="Variation Type (e.g., Size)" required>
            </div>
            <div class="col-md-4">
                <input type="text" name="variations[${variationIndex}][value]" class="form-control" placeholder="Variation Value (e.g., Medium)" required>
            </div>
            <div class="col-md-4">
                <input type="text" name="variations[${variationIndex}][price]" class="form-control" placeholder="Additional Price (e.g., 20.00)" required>
            </div>
        `;
        container.appendChild(row);
        variationIndex++;
    });
</script>

@endsection
