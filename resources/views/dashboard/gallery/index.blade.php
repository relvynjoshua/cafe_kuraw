@extends('layouts.dashboard')

@section('content')
<div class="container">
    <a href="{{ route('dashboard.gallery.create') }}" class="btn btn-primary mb-3">Add New Gallery Item</a>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Title</th>
                <th>Category</th>
                <th>Image</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($galleryItems as $item)
                <tr>
                    <td>{{ $item->title }}</td>
                    <td>{{ $item->category }}</td>
                    <td><img src="{{ asset('storage/' . $item->image) }}" alt="{{ $item->title }}" width="100"></td>
                    <td>
                        <a href="{{ route('dashboard.gallery.edit', $item) }}" class="btn btn-warning btn-sm">Edit</a>
                        <form action="{{ route('dashboard.gallery.destroy', $item) }}" method="POST"
                            style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm"
                                onclick="return confirm('Are you sure you want to delete this item?')">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection