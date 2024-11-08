@extends('layouts.dashboard')

@section('content')
    <div class="container">
        <h1>User Profiles</h1>
        <form action="{{ route('profile.index') }}" method="GET">
            <div class="input-group mb-3">
                <input type="text" class="form-control" placeholder="Search by ID" name="search">
                <button class="btn btn-outline-secondary" type="submit">Search</button>
            </div>
        </form>
        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($users as $user)
                    <tr><td>{{ $user->id }}</td><td>{{ $user->name }}</td><td>{{ $user->email }}</td><td><a href="{{ route('profile.edit', $user->id) }}" class="btn btn-primary">Edit</a></td></tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
