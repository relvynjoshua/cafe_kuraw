@extends('layouts.dashboard')

@section('content')

@include('components.alert')
    <h1>List of Products</h1>
    <a href="{{ route('product.showAdd') }}" class="btn btn-primary">Add Product</a>
    <table class="table">
        <thead>
            <tr>
                <th scope="col">ID</th>
                <th scope="col">Name</th>
                <th scope="col">Category</th>
                <th scope="col">Price</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($products as $product)
                <tr>
                    <td scope="row">{{ $product->id }}</td>
                    <td>{{ $product->name }}</td>
                    <td>{{ $product->category->name ?? 'N/A'}}</td>
                    <td>{{ $product->price }}</td>
                    <td>
                        <a href="{{ route('product.edit', [ 'id' => $product->id ]) }}" class="btn btn-sm btn-warning">Edit</a>
                        <form action="{{ route('product.destroy', [ 'id' => $product->id ]) }}" method="POST" style="display: inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
