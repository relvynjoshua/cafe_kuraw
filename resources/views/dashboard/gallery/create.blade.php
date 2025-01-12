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
    <h2 class="mb-4">Add New Gallery Item</h2>
    <h6>Please upload photos in JPG format only.</h6>
    <hr class="solid">

    <form action="{{ route('dashboard.gallery.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="form-group mb-3">
            <label for="title" class="form-label fw-bold">Title</label>
            <input type="text" name="title" id="title" class="form-control" placeholder="Enter title" required>
            @error('title')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>

        <div class="form-group mb-3">
            <label for="description" class="form-label fw-bold">Description</label>
            <textarea name="description" id="description" class="form-control" rows="5" placeholder="Enter description" required></textarea>
            @error('description')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>

        <div class="form-group mb-3">
            <label for="category" class="form-label fw-bold">Category</label>
            <input type="text" name="category" id="category" class="form-control" placeholder="Enter category">
            @error('category')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>

        <div class="form-group mb-3">
            <label for="image" class="form-label fw-bold">Image</label>
            <input 
                type="file" 
                name="image" 
                id="image" 
                class="form-control" 
                accept=".jpg,.jpeg" 
                required 
                onchange="validateFile()"
            >
            <span id="fileError" class="text-danger d-none">Please upload an image in JPG format only.</span>
            @error('image')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>

        <button type="submit" class="btn btn-primary">Add Item</button>
    </form>
</div>

<script>
    function validateFile() {
        const fileInput = document.getElementById('image');
        const fileError = document.getElementById('fileError');
        const filePath = fileInput.value;
        const allowedExtensions = /(\.jpg|\.jpeg)$/i;

        if (!allowedExtensions.exec(filePath)) {
            fileError.classList.remove('d-none');
            fileInput.value = ''; // Clear the input value
        } else {
            fileError.classList.add('d-none');
        }
    }
</script>

@endsection
