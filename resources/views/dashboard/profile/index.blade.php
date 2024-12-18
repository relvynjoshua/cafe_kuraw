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

    /* Styling for the container */
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
        <i class="fas fa-user"></i> User Management
    </h1>
    <h6>List of all user profiles</h6>

    <!-- Search Bar -->
    <form method="GET" action="{{ route('dashboard.profile.index') }}" class="mb-3">
        <div class="d-flex">
            <input type="text" name="search" class="form-control me-2" placeholder="Search by Name or Email"
                value="{{ request('search') }}">

            <select name="status" class="form-control me-2">
                <option value="">All</option>
                <option value="active" {{ request('status') == 'active' ? 'selected' : '' }}>Active</option>
                <option value="inactive" {{ request('status') == 'inactive' ? 'selected' : '' }}>Inactive</option>
            </select>

            <select name="sort" class="form-control me-2">
                <option value="id">ID</option>
                <option value="firstname">Name</option>
                <option value="email">Email</option>
            </select>

            <select name="direction" class="form-control me-2">
                <option value="asc" {{ request('direction') == 'asc' ? 'selected' : '' }}>Ascending</option>
                <option value="desc" {{ request('direction') == 'desc' ? 'selected' : '' }}>Descending</option>
            </select>

            <button type="submit" class="btn btn-outline-primary">Filter</button>
        </div>
    </form>

    <div class="card shadow">
        <div class="card-body">
            <table class="table table-striped table-bordered">
                <thead class="thead-dark">
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($users as $user)
                        <tr>
                            <td>{{ $user->id }}</td>
                            <td>{{ $user->firstname }}</td>
                            <td>{{ $user->email }}</td>
                            <td>
                                @if ($user->is_active)
                                    <form action="{{ route('dashboard.profile.disable', $user->id) }}" method="POST"
                                        style="display: inline;">
                                        @csrf
                                        @method('PATCH')
                                        <button type="submit" class="btn btn-danger btn-sm">
                                            <i class="fas fa-ban"></i> Disable
                                        </button>
                                    </form>
                                @else
                                    <form action="{{ route('dashboard.profile.enable', $user->id) }}" method="POST"
                                        style="display: inline;">
                                        @csrf
                                        @method('PATCH')
                                        <button type="submit" class="btn btn-success btn-sm">
                                            <i class="fas fa-check"></i> Enable
                                        </button>
                                    </form>
                                @endif

                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="text-center">No users found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <!-- Pagination Links -->
    <div class="pagination">
        <!-- Previous arrow -->
        <a href="#" class="arrow" onclick="changePage('prev')">«</a>

        <!-- Page Numbers -->
        <span>Page {{ $users->currentPage() }} of {{ $users->lastPage() }}</span>

        <!-- Next arrow -->
        <a href="#" class="arrow" onclick="changePage('next')">»</a>
    </div>
</div>
</div>

<script>
    // Function to change pages
    function changePage(direction) {
        const currentPage = {{ $users->currentPage() }};
        let newPage = direction === 'next' ? currentPage + 1 : currentPage - 1;
        if (newPage < 1) newPage = 1;
        if (newPage > {{ $users->lastPage() }}) newPage = {{ $users->lastPage() }};
        window.location.href = '{{ route('dashboard.profile.index') }}?page=' + newPage;
    }
</script>

@endsection