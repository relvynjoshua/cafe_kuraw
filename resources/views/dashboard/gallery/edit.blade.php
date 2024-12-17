@extends('layouts.dashboard')

@section('content')
<div class="container">
    <h2>Edit Gallery Item</h2>
    <form action="{{ route('dashboard.gallery.update', $galleryItem) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label for="title" class="form-label">Title</label>
            <input type="text" name="title" id="title" class="form-control" value="{{ $galleryItem->title }}" required>
        </div>
        <div class="mb-3">
            <label for="description" class="form-label">Description</label>
            <textarea name="description" id="description" class="form-control" rows="5" required>{{ $galleryItem->description }}</textarea>
        </div>
        <div class="mb-3">
            <label for="category" class="form-label">Category</label>
            <input type="text" name="category" id="category" class="form-control" value="{{ $galleryItem->category }}">
        </div>
        <div class="mb-3">
            <label for="image" class="form-label">Image</label>
            <input type="file" name="image" id="image" class="form-control">
            <small>Leave this blank to keep the current image.</small>
            <br>
            <img src="{{ asset('storage/' . $galleryItem->image) }}" alt="{{ $galleryItem->title }}" width="150" class="mt-2">
        </div>
        <button type="submit" class="btn btn-primary">Update Item</button>
    </form>
</div>
@endsection
