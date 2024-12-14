@extends('layouts.dashboard')

@section('content')

@include('components.alert')

<style>
    /* Solid border */
    hr.solid {
        border-top: 5px solid #000000;
    }
</style>

<a href="{{ route('dashboard.category.index') }}" class="btn btn-secondary mb-3">Back to Categories</a>

<div class="card shadow p-4">
    <h2 class="mb-4">Edit Category</h2>
    <hr class="solid">

    <form action="{{ route('dashboard.category.update', $category->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="form-group mb-3">
            <label for="name" class="form-label fw-bold">Category Name</label>
            <input 
                type="text" 
                name="name" 
                class="form-control @error('name') is-invalid @enderror" 
                id="name" 
                value="{{ old('name', $category->name) }}" 
                required
            >
            @error('name')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>

        <!-- Optional Category Description -->
        <!-- Uncomment this if you want to include category descriptions -->
        <!-- 
        <div class="form-group mb-3">
            <label for="description" class="form-label">Category Description</label>
            <textarea 
                name="description" 
                class="form-control @error('description') is-invalid @enderror" 
                id="description">{{ old('description', $category->description) }}</textarea>
            @error('description')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
        -->

        <button type="submit" class="btn btn-primary">Update Category</button>
    </form>
</div>

@endsection
