@extends('layouts.app')

@section('title', $galleryItem->title)

@section('content')
<div class="container my-5">
    <h1 class="text-center">{{ $galleryItem->title }}</h1>
    <img src="{{ asset('storage/' . $galleryItem->image) }}" class="img-fluid my-4" alt="{{ $galleryItem->title }}">
    <p>{{ $galleryItem->description }}</p>
    <a href="{{ route('dashboard.gallery.index') }}" class="btn btn-primary">Back to Gallery</a>
</div>
@endsection
