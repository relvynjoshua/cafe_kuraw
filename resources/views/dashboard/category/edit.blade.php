@extends('layouts.dashboard')

@section('content')

@include('components.alert')
<div class="container mt-4">
    <div class="card shadow-sm">
        <div class="card-header bg-warning text-black">
            <h3>Edit Category</h3>
        </div>
        <div class="card-body">
            <a href="{{ route('dashboard.category.index') }}" class="btn btn-secondary mb-3">
                <i class="fas fa-arrow-left"></i> Back to Categories
            </a>
            <form action="{{ route('dashboard.category.update', $category->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <label for="name">Category Name</label>
                    <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" id="name" value="{{ $category->name }}" required>
                    @error('name')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <button type="submit" class="btn btn-success mt-3">
                    <i class="fas fa-save"></i> Update Category
                </button>
            </form>
        </div>
    </div>
</div>
@endsection
