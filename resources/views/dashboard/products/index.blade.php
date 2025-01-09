@extends('layouts.dashboard')

@section('content')

@include('components.alert')

<style>
    /* Pagination container */
    .pagination {
        display: flex;
        justify-content: center;
        align-items: center;
        margin-top: 20px;
    }

    /* Pagination list */
    .pagination ul {
        list-style-type: none;
        padding: 0;
        margin: 0;
        display: flex;
    }

    /* Pagination items */
    .pagination li {
        margin: 0 5px;
    }

    /* Pagination links */
    .pagination a {
        display: inline-block;
        padding: 6px 12px;
        /* Adjusted padding for better button size */
        color: #007bff;
        text-decoration: none;
        border: 1px solid #ddd;
        border-radius: 3px;
        background-color: #fff;
        transition: background-color 0.3s, color 0.3s;
        font-size: 1rem;
        /* Adjusted font size for page numbers */
        line-height: 1.5;
    }

    /* Hover and active state */
    .pagination a:hover,
    .pagination .active a {
        background-color: #007bff;
        color: white;
    }

    /* Disabled state */
    .pagination .disabled a {
        color: #ccc;
        pointer-events: none;
    }

    /* Arrow buttons */
    .pagination .arrow {
        font-size: 1.2rem;
        /* Make the arrows a bit bigger */
        padding: 6px 10px;
    }

    /* Arrow hover effect */
    .pagination .arrow:hover {
        background-color: #007bff;
        color: white;
    }

    /* Adjust spacing and layout for responsiveness */
    @media (max-width: 768px) {
        .pagination .page-link {
            font-size: 10px;
            /* Smaller font size on smaller screens */
            padding: 3px 6px;
            /* Adjust padding for compact display */
        }
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

    .variation-table th,
    .variation-table td {
        padding: 5px;
    }

    .table-responsive {
        overflow-x: auto;
        white-space: nowrap;
        background-color: #f9f9f9;
        padding: 15px;
        border-radius: 8px;
    }
</style>

<div class="container mt-4" style="max-width: 100%; width: 98%;">
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

    <a href="{{ route('dashboard.products.showAdd') }}" class="btn btn-primary mb-3">
        <i class="fas fa-plus"></i> Add Product
    </a>

    <div class="table-responsive">
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
        <div class="pagination">
            <!-- Previous arrow -->
            <a href="#" class="arrow" onclick="changePage('prev')">«</a>

            <!-- Page Numbers -->
            <span>Page {{ $products->currentPage() }} of {{ $products->lastPage() }}</span>

            <!-- Next arrow -->
            <a href="#" class="arrow" onclick="changePage('next')">»</a>
        </div>
    </div>
</div>

<script>
    // Function to change pages
    function changePage(direction) {
        const currentPage = {{ $products->currentPage() }};
        let newPage = direction === 'next' ? currentPage + 1 : currentPage - 1;
        if (newPage < 1) newPage = 1;
        if (newPage > {{ $products->lastPage() }}) newPage = {{ $products->lastPage() }};
        window.location.href = '{{ route('dashboard.products.index') }}?page=' + newPage;
    }
</script>

@endsection