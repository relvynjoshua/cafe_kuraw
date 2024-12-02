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

    /* Styling for the container */
    .container {
        background-color: #f9f9f9;
        padding: 20px;
        border-radius: 8px;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    }

    h1, h6 {
        color: #333;
    }
</style>

<div class="container mt-4">
    <h1>
        <i class="fas fa-user"></i> User Profiles
    </h1>
    <h6>List of all user profiles</h6>

    <!-- Search Bar -->
    <form action="{{ route('dashboard.profile.index') }}" method="GET" class="d-flex mb-3">
        <input type="text" name="search" class="form-control me-2" placeholder="Search by Name or Email" value="{{ request('search') }}">
        <button class="btn btn-outline-primary" type="submit">Search</button>
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
                                <a href="{{ route('dashboard.profile.edit', $user->id) }}" class="btn btn-warning btn-sm">
                                    <i class="fas fa-edit"></i> Edit
                                </a>
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
    <div class="d-flex justify-content-center mt-3">
        {{ $users->appends(request()->query())->links() }}
    </div>
</div>

@endsection
