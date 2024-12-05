@extends('layouts.dashboard')

@section('content')

@include('components.alert')

<style>
    /* Styling for pagination */
    .pagination .page-link {
        font-size: 12px;
        padding: 5px 10px;
        color: #007bff;
        border: 1px solid #dee2e6;
    }

    .pagination .page-link:hover {
        color: #0056b3;
        text-decoration: none;
    }

    .pagination .page-item.active .page-link {
        background-color: #007bff;
        color: #fff;
        border-color: #007bff;
    }

    .pagination .page-item {
        margin: 0 2px;
    }

    .container {
        background-color: #f9f9f9;
        padding: 20px;
        border-radius: 8px;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    }

    h1,
    h6 {
        color: #333;
    }

    .variation-table {
        font-size: 12px;
    }

    .variation-table th, .variation-table td {
        padding: 5px;
    }
</style>

<div class="container mt-4">
    <h1>
        <i class="fas fa-box"></i> Products
    </h1>
    <h6>List of all products</h6>

    <!-- Search Bar -->
    <form action="{{ route('dashboard.products.index') }}" method="GET" class="d-flex mb-3">
        <input type="text" name="search" class="form-control me-2" placeholder="Search by Name, Category, or Price"
            value="{{ request('search') }}">
        <button class="btn btn-outline-primary" type="submit">Search</button>
    </form>

    <a href="{{ route('dashboard.products.showAdd') }}" class="btn btn-primary mb-3">Add Product</a>

    <table class="table table-striped table-bordered">
        <thead class="thead-dark">
            <tr>
                <th scope="col">ID</th>
                <th scope="col">Name</th>
                <th scope="col">Image</th>
                <th scope="col">Category</th>
                <th scope="col">Description</th>
                <th scope="col">Base Price</th>
                <th scope="col">Variations</th>
                <th scope="col">Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($products as $product)
                <tr>
                    <td scope="row">{{ $product->id }}</td>
                    <td>{{ $product->name }}</td>
                    <td>
                        @if ($product->image)
                            <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}"
                                style="width: 50px; height: 50px;">
                        @else
                            <span>No Image</span>
                        @endif
                    </td>
                    <td>{{ $product->category->name ?? 'N/A' }}</td>
                    <td>{{ $product->description }}</td>
                    <td>₱{{ number_format($product->price, 2) }}</td>
                    <td>
                        @if ($product->variations->count() > 0)
                            <table class="table table-sm table-bordered variation-table">
                                <thead>
                                    <tr>
                                        <th>Type</th>
                                        <th>Value</th>
                                        <th>Price</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($product->variations as $variation)
                                        <tr>
                                            <td>{{ $variation->type }}</td>
                                            <td>{{ $variation->value }}</td>
                                            <td>₱{{ number_format($variation->price, 2) }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        @else
                            <span>No Variations</span>
                        @endif
                    </td>
                    <td>
                        <a href="{{ route('dashboard.products.showEdit', ['id' => $product->id]) }}"
                            class="btn btn-warning btn-sm">
                            <i class="fas fa-edit"></i> Edit
                        </a>
                        <form action="{{ route('dashboard.products.destroy', ['id' => $product->id]) }}" method="POST"
                            style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm">
                                <i class="fas fa-trash-alt"></i> Delete
                            </button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="8" class="text-center">No products found.</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <!-- Pagination Links -->
    <div class="d-flex justify-content-center mt-3">
        {{ $products->links() }}
    </div>
</div>

@endsection
