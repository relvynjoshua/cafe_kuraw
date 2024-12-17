@extends('layouts.dashboard')

@section('content')

<style>
    h1 {
        font-size: 24px;
        color: #333;
        margin-bottom: 20px;
    }

    .table th,
    .table td {
        padding: 10px;
    }

    .table th {
        background-color: #f8f9fa;
    }

    .table tr:nth-child(even) {
        background-color: #f2f2f2;
    }

    .table tr:hover {
        background-color: #e9ecef;
    }

    .btn.btn-secondary {
        margin-top: 20px;
        padding: 10px 15px;
    }

    .table-responsive {
        overflow-x: auto;
    }

    img.gallery-image {
        max-width: 200px;
        border: 1px solid #ddd;
        border-radius: 5px;
        padding: 5px;
        margin-top: 10px;
    }
</style>

<h1>Gallery Item Details</h1>
<div class="table-responsive">
    <table class="table">
        <tr>
            <th>ID</th>
            <td>{{ $galleryItem->id }}</td>
        </tr>
        <tr>
            <th>Title</th>
            <td>{{ $galleryItem->title }}</td>
        </tr>
        <tr>
            <th>Category</th>
            <td>{{ $galleryItem->category ?? 'N/A' }}</td>
        </tr>
        <tr>
            <th>Description</th>
            <td>{{ $galleryItem->description ?? 'No description available' }}</td>
        </tr>
        <tr>
            <th>Image</th>
            <td>
                <img src="{{ asset('storage/' . $galleryItem->image) }}" alt="{{ $galleryItem->title }}" class="gallery-image">
            </td>
        </tr>
    </table>
</div>

<a href="{{ route('dashboard.gallery.index') }}" class="btn btn-secondary">Back to Gallery</a>

@endsection
