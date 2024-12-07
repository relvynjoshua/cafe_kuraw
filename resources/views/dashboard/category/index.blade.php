@extends('layouts.dashboard')

@section('content')

@include('components.alert')

<style>
    /* Styling for pagination */
    .pagination {
        display: flex;
        justify-content: center;
        margin-top: 15px;
        margin-bottom: 15px;
        /* Centered and smaller vertical margin */
    }

    .pagination .page-link {
        font-size: 12px;
        /* Smaller font size */
        padding: 4px 8px;
        /* Adjust padding for compact size */
        color: #007bff;
        /* Default Bootstrap link color */
        border: 1px solid #dee2e6;
        /* Border for pagination buttons */
        border-radius: 4px;
        /* Rounded corners for buttons */
        transition: all 0.3s ease-in-out;
        /* Smooth hover effect */
    }

    .pagination .page-link:hover {
        color: #0056b3;
        /* Darker link on hover */
        background-color: #f0f8ff;
        /* Light background on hover */
        text-decoration: none;
        /* Remove underline */
    }

    .pagination .page-item.active .page-link {
        background-color: #007bff;
        /* Active background color */
        color: #fff;
        /* Active text color */
        border-color: #007bff;
        /* Active border color */
        font-weight: bold;
        /* Highlight the active link */
    }

    .pagination .page-item {
        margin: 0 2px;
        /* Reduce spacing between buttons */
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


    /* Styling for the container */
    .container {
        background-color: #f9f9f9;
        /* Light gray background */
        padding: 20px;
        border-radius: 8px;
        /* Rounded corners */
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        /* Subtle shadow */
    }

    h1,
    h6 {
        color: #333;
        /* Darker text color for headers */
    }
</style>

<div class="container mt-4">
    <h1>
        <i class="fas fa-chart-pie"></i> Categories
    </h1>
    <h6>List of all categories</h6>

    <!-- Search Bar -->
    <form action="{{ route('dashboard.category.index') }}" method="GET" class="d-flex mb-3">
        <input type="text" name="search" class="form-control me-2" placeholder="Search by Category Name"
            value="{{ request('search') }}">
        <button class="btn btn-outline-primary" type="submit">Search</button>
    </form>

    <a href="{{ route('dashboard.category.create') }}" class="btn btn-primary mb-3">
        <i class="fas fa-plus"></i> Add Category
    </a>

    <table class="table table-striped table-bordered">
        <thead class="thead-dark">
            <tr>
                <th scope="col">ID</th>
                <th scope="col">Name</th>
                <th scope="col">Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($categories as $category)
                <tr>
                    <td scope="row">{{ $category->id }}</td>
                    <td>{{ $category->name }}</td>
                    <td>
                        <a href="{{ route('dashboard.category.edit', $category->id) }}" class="btn btn-warning btn-sm">
                            <i class="fas fa-edit"></i> Edit
                        </a>
                        <form action="{{ route('dashboard.category.destroy', $category->id) }}" method="POST"
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
                    <td colspan="3" class="text-center">No categories found.</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <!-- Pagination Links -->
    <div class="d-flex justify-content-center mt-3">
        {{ $categories->links() }}
    </div>
</div>

@endsection