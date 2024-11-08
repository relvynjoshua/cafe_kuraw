@extends('layouts.dashboard')

@section('content')
    <h1>Product Details</h1>
    <table class="table">
        <tr>
            <th>ID</th>
            <td>{{ $product->id }}</td>
        </tr>
        <tr>
            <th>Name</th>
            <td>{{ $product->name }}</td>
        </tr>
        <tr>
            <th>Category</th>
            <td>{{ $product->category->name }}</td>
        </tr>
        <tr>
            <th>Price</th>
            <td>{{ $product->price }}</td>
        </tr>
    </table>
    <a href="{{ route('product.index') }}" class="btn btn-secondary">Back to Products</a>
@endsection

