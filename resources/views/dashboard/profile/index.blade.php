@extends('layouts.dashboard')

@section('content')

@include('components.alert')

<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1>User Profiles</h1>
        <form action="{{ route('dashboard.profile.index') }}" method="GET" class="d-flex">
            <input type="text" class="form-control me-2" placeholder="Search by Name or Email" name="search">
            <button class="btn btn-outline-primary" type="submit">Search</button>
        </form>
    </div>

    <div class="card shadow">
        <div class="card-body">
            <table class="table table-hover">
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
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->email }}</td>
                            <td>
                                <a href="{{ route('profile.edit', $user->id) }}" class="btn btn-sm btn-warning">Edit</a>
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
</div>

@endsection
