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

    .pagination ul {
        list-style-type: none;
        padding: 0;
        margin: 0;
        display: flex;
    }

    .pagination li {
        margin: 0 5px;
    }

    .pagination a {
        display: inline-block;
        padding: 6px 12px;
        color: #007bff;
        text-decoration: none;
        border: 1px solid #ddd;
        border-radius: 3px;
        background-color: #fff;
        transition: background-color 0.3s, color 0.3s;
        font-size: 1rem;
    }

    .pagination a:hover,
    .pagination .active a {
        background-color: #007bff;
        color: white;
    }

    .pagination .disabled a {
        color: #ccc;
        pointer-events: none;
    }

    /* Arrow buttons */
    .pagination .arrow {
        font-size: 1.2rem;
        padding: 6px 10px;
    }

    .pagination .arrow:hover {
        background-color: #007bff;
        color: white;
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
</style>

<div class="container mt-4" style="max-width: 100%; width: 90%;">
    <h1>
        <i class="fas fa-images"></i> Gallery Management
    </h1>
    <h6>List of all gallery items</h6>

    <!-- Search Bar -->
    <form action="{{ route('dashboard.gallery.index') }}" method="GET" class="d-flex mb-3">
        <input type="text" name="search" class="form-control me-2" placeholder="Search by Title or Category"
            value="{{ request('search') }}">
        <button class="btn btn-outline-primary" type="submit">Search</button>
    </form>

    <!-- Add New Button -->
    <a href="{{ route('dashboard.gallery.create') }}" class="btn btn-primary mb-3">
        <i class="fas fa-plus"></i> Add New Gallery Item
    </a>

    <!-- Table -->
    <table class="table table-striped table-bordered">
        <thead class="thead-dark">
            <tr>
                <th scope="col">ID</th>
                <th scope="col">Title</th>
                <th scope="col">Category</th>
                <th scope="col">Description</th>
                <th scope="col">Image</th>
                <th scope="col">Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($galleryItems as $item)
                <tr>
                    <td>{{ $item->id }}</td>
                    <td>{{ $item->title }}</td>
                    <td>{{ $item->category }}</td>
                    <td>{{ $item->description ?? 'No description provided' }}</td>
                    <td>
                        <img src="{{ asset('storage/' . $item->image) }}" alt="{{ $item->title }}" width="100"
                            class="img-thumbnail">
                    </td>
                    <td>
                        <a href="{{ route('dashboard.gallery.edit', $item->id) }}" class="btn btn-warning btn-sm">
                            <i class="fas fa-edit"></i> Edit
                        </a>
                        <form action="{{ route('dashboard.gallery.destroy', $item->id) }}" method="POST"
                            style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm"
                                onclick="return confirm('Are you sure you want to delete this item?')">
                                <i class="fas fa-trash-alt"></i> Delete
                            </button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="6" class="text-center">No gallery items found.</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <!-- Pagination Links -->
    <div class="pagination">
        <!-- Previous arrow -->
        <a href="#" class="arrow" onclick="changePage('prev')">«</a>

        <!-- Page Numbers -->
        <span>Page {{ $galleryItems->currentPage() }} of {{ $galleryItems->lastPage() }}</span>

        <!-- Next arrow -->
        <a href="#" class="arrow" onclick="changePage('next')">»</a>
    </div>
</div>

<script>
    // Function to change pages
    function changePage(direction) {
        const currentPage = {{ $galleryItems->currentPage() }};
        let newPage = direction === 'next' ? currentPage + 1 : currentPage - 1;
        if (newPage < 1) newPage = 1;
        if (newPage > {{ $galleryItems->lastPage() }}) newPage = {{ $galleryItems->lastPage() }};
        window.location.href = '{{ route('dashboard.gallery.index') }}?page=' + newPage;
    }
</script>

@endsection
