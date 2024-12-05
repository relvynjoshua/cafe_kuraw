@extends('layouts.dashboard')

@section('content')

@include('components.alert')

<a href="{{ route('dashboard.products.index') }}" class="btn btn-secondary mb-3">Back to Products</a>

<div class="card shadow p-4">
    <h2 class="mb-4">Edit Product</h2>
    <form action="{{ route('dashboard.products.update', ['id' => $product->id]) }}" method="POST" enctype="multipart/form-data">
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
            <label for="price" class="form-label">Base Price</label>
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

        <div class="form-group mb-3">
            <label for="image" class="form-label">Product Image</label>
            <input type="file" name="image" id="image" class="form-control">
            @if ($product->image)
                <img src="{{ asset($product->image) }}" alt="{{ $product->name }}" class="img-thumbnail mt-2" style="width: 150px;">
            @endif
            @error('image')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>

        <!-- Existing Variations -->
        <div id="variations-container">
            <h4 class="mt-4">Product Variations</h4>
            @foreach ($product->variations as $index => $variation)
                <div class="variation-row row mb-3">
                    <div class="col-md-4">
                        <input type="text" name="variations[{{ $index }}][type]" class="form-control" value="{{ $variation->type }}" placeholder="Variation Type (e.g., Size)" required>
                    </div>
                    <div class="col-md-4">
                        <input type="text" name="variations[{{ $index }}][value]" class="form-control" value="{{ $variation->value }}" placeholder="Variation Value (e.g., Medium)" required>
                    </div>
                    <div class="col-md-4">
                        <input type="text" name="variations[{{ $index }}][price]" class="form-control" value="{{ $variation->price }}" placeholder="Additional Price (e.g., 20.00)" required>
                    </div>
                </div>
            @endforeach
        </div>
        <button type="button" class="btn btn-secondary" id="add-variation-btn">Add Variation</button>

        <button type="submit" class="btn btn-primary">Update Product</button>
    </form>
</div>

<script>
    let variationIndex = {{ $product->variations->count() }};

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
