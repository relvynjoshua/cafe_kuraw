@extends('layouts.dashboard')

@section('content')

@include('components.alert')

<style>
    /* Styling for pagination */
    .pagination .page-link {
        font-size: 12px; /* Smaller font size */
        padding: 5px 10px; /* Adjust padding for smaller size */
        color: #007bff; /* Default Bootstrap link color */
        border: 1px solid #dee2e6; /* Border for pagination buttons */
    }

    .pagination .page-link:hover {
        color: #0056b3; /* Darker link on hover */
        text-decoration: none; /* Remove underline */
    }

    .pagination .page-item.active .page-link {
        background-color: #007bff; /* Active background color */
        color: #fff; /* Active text color */
        border-color: #007bff; /* Active border color */
    }

    .pagination .page-item {
        margin: 0 2px; /* Reduce spacing between buttons */
    }

    /* Styling for the container */
    .container {
        background-color: #f9f9f9; /* Light gray background */
        padding: 20px;
        border-radius: 8px; /* Rounded corners */
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1); /* Subtle shadow */
    }

    h1, h6 {
        color: #333; /* Darker text color for headers */
    }
</style>

<div class="container mt-4">
    <h1>Categories</h1>
    <h6>List of all categories</h6>
    <a href="{{ route('dashboard.category.create') }}" class="btn btn-primary mb-3">Add Category</a>
    <table class="table table-striped table-bordered">
        <thead class="thead-dark">
            <tr>
                <th scope="col">ID</th>
                <th scope="col">Name</th>
                <th scope="col">Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($categories as $category)
                <tr>
                    <td scope="row">{{ $category->id }}</td>
                    <td>{{ $category->name }}</td>
                    <td>
                        <a href="{{ route('dashboard.category.edit', $category->id) }}" class="btn btn-warning btn-sm">
                            <i class="fas fa-edit"></i> Edit
                        </a>
                        <form action="{{ route('dashboard.category.destroy', $category->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm">
                                <i class="fas fa-trash-alt"></i> Delete
                            </button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <!-- Pagination Links -->
    <div class="d-flex justify-content-center mt-3">
        {{ $categories->links() }}
    </div>
</div>

@endsection
