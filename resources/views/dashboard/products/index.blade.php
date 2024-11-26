@extends('layouts.dashboard')

@section('content')

@include('components.alert')

<div class="d-flex justify-content-between align-items-center mb-4">
    <h1>Product List</h1>
    <a href="{{ route('dashboard.products.showAdd') }}" class="btn btn-primary">Add Product</a>
</div>

<div class="card shadow">
    <div class="card-body">
        <table class="table table-striped">
            <thead class="thead-dark">
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
                @forelse ($products as $product)
                    <tr>
                        <td>{{ $product->id }}</td>
                        <td>{{ $product->name }}</td>
                        <td>{{ $product->category->name ?? 'N/A' }}</td>
                        <td>{{ $product->description }}</td>
                        <td>{{ $product->price }}</td>
                        <td>
                            <a href="{{ route('dashboard.products.showEdit', ['id' => $product->id]) }}" class="btn btn-warning btn-sm">Edit</a>
                            <form action="{{ route('dashboard.products.destroy', ['id' => $product->id]) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="text-center">No products found.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

@endsection
