@extends('layouts.dashboard')

@section('content')

@include('components.alert')
    <a href="{{ route('dashboard.category.index') }}" class="btn btn-secondary">Back to Categories</a>
    
    <h1>Edit Category</h1>
    <form action="{{ route('dashboard.category.update', $category->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="name">Category Name</label>
            <input type="text" name="name" class="form-control" id="name" value="{{ $category->name }}" required>

            @error('name')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
        
        <button type="submit" class="btn btn-primary">Update Category</button>
    </form>
@endsection
