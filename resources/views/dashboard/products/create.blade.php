@extends('layouts.dashboard')

@section('content')
    <h1>Add Product</h1>
    <form action="{{ route('dashboard.product.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="name">Product Name</label>
            <input type="text" name="name" class="form-control" id="name">
        </div>
        <div class="form-group">
            <label for="category_id">Category</label>
            <select name="category_id" class="form-control">
                @foreach($categories as $category)
                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="price">Price</label>
            <input type="text" name="price" class="form-control" id="price">
        </div>
        <button type="submit" class="btn btn-primary">Add Product</button>
    </form>
@endsection
