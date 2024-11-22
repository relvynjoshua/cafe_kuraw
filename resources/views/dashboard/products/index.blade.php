@extends('layouts.dashboard')

@section('content')

@include('components.alert')
    <h1>List of Products</h1>
    <a href="{{ route('dashboard.products.showAdd') }}" class="btn btn-primary">Add Product</a>
    <table class="table">
        <thead>
            <tr>
                <th scope="col">ID</th>
                <th scope="col">Name</th>
                <th scope="col">Category</th>
                <th scope="col">Description</th>
                <th scope="col">Price</th>
                <th scope="col">Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($products as $product)
                <tr>
                    <td scope="row">{{ $product->id }}</td>
                    <td>{{ $product->name }}</td>
                    <td>{{ $product->category->name ?? 'N/A' }}</td>
                    <td>{{ $product->description }}</td>
                    <td>{{ $product->price }}</td>
                    <td>
                        <a href="{{ route('dashboard.products.destroy', ['id' => $product->id]) }}" class="btn btn-danger">Delete</a>
                        <a href="{{ route('dashboard.products.showEdit', ['id' => $product->id]) }}" class="btn btn-warning">Edit</a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
