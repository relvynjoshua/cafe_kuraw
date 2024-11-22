@extends('layouts.dashboard')

@section('content')

@include('components.alert')
    <h1>List of Categories</h1>
    <a href="{{ route('dashboard.category.create') }}" class="btn btn-primary">Add Category</a>
    <table class="table">
        <thead>
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
                        <a href="{{ route('dashboard.category.edit', $category->id) }}" class="btn btn-warning">Edit</a>
                        <form action="{{ route('dashboard.category.destroy', $category->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
