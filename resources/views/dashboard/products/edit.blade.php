@extends('layouts.dashboard')

@section('content')
    <h1>Edit Product</h1>
    <form action="{{ route('dashboard.product.update', $product) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="name">Product Name</label>
            <input type="text" name="name" class="form-control" id="name" value="{{ $product->name }}">
        </div>
        <div class="form-group">
            <label for="category_id">Category</label>
            <select name="category_id" class="form-control">
                @foreach($categories as $category)
                    <option value="{{ $category->id }}" @if($product->category_id == $category->id) selected @endif>{{ $category->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="price">Price</label>
            <input type="text" name="price" class="form-control" id="price" value="{{ $product->price }}">
        </div>
        <button type="submit" class="btn btn-primary">Update Product</button>
    </form>
@endsection
