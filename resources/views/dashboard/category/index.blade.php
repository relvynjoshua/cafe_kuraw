@extends('layouts.dashboard')

@section('content')

@include('components.alert')
    <h1>List of Categories</h1>
    <a href="{{ route('dashboard.category.create') }}" class="btn btn-primary">Add Category</a>
    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($categories as $category)
                <tr>
                    <td>{{ $category->id }}</td>
                    <td>{{ $category->name }}</td>
                    <td>
                        <a href="{{ route('dashboard.category.edit', $category) }}" class="btn btn-sm btn-warning">Edit</a>
                        <form action="{{ route('dashboard.category.destroy', $category) }}" method="POST" style="display: inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
