@extends('layouts.dashboard')

@section('content')

@include('components.alert')
    <a href="{{ route('dashboard.category.index') }}" class="btn btn-secondary">Back to Categories</a>
    
    <h1>Add Category</h1>
    <form action="{{ route('dashboard.category.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="name">Category Name</label>
            <input type="text" name="name" class="form-control" id="name" required>
        </div>
        <button type="submit" class="btn btn-primary">Add Category</button>
    </form>
@endsection
