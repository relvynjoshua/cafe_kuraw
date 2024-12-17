@extends('layouts.dashboard')

@section('content')

@include('components.alert')
<style>
    /* Solid border */
    hr.solid {
        border-top: 5px solid #000000;
    }
</style>

<a href="{{ route('dashboard.gallery.index') }}" class="btn btn-secondary mb-3">Back to Gallery</a>

<div class="card shadow p-4">
    <h2 class="mb-4">Edit Gallery Item</h2>
    <hr class="solid">

    <form action="{{ route('dashboard.gallery.update', $galleryItem) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="form-group mb-3">
            <label for="title" class="form-label fw-bold">Title</label>
            <input type="text" name="title" id="title" class="form-control" value="{{ $galleryItem->title }}" required>
            @error('title')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>

        <div class="form-group mb-3">
            <label for="description" class="form-label fw-bold">Description</label>
            <textarea name="description" id="description" class="form-control" rows="5" required>{{ $galleryItem->description }}</textarea>
            @error('description')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>

        <div class="form-group mb-3">
            <label for="category" class="form-label fw-bold">Category</label>
            <input type="text" name="category" id="category" class="form-control" value="{{ $galleryItem->category }}">
            @error('category')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>

        <div class="form-group mb-3">
            <label for="image" class="form-label fw-bold">Image</label>
            <input type="file" name="image" id="image" class="form-control">
            <small class="text-muted">Leave this blank to keep the current image.</small>
            <br>
            <img src="{{ asset('storage/' . $galleryItem->image) }}" alt="{{ $galleryItem->title }}" width="150" class="mt-2 border">
            @error('image')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>

        <button type="submit" class="btn btn-primary">Update Item</button>
    </form>
</div>

@endsection
