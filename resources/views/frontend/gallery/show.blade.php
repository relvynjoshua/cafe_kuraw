@extends('layouts.app')

@section('title', $galleryItem->title)

@section('content')
<div class="page-banner page-banner-overlay" style="background-image: url('{{ asset('assets/img/white.png') }}');">
    <div class="container h-100">
        <div class="row h-100">
            <div class="col-lg-12 my-auto">
                <div class="page-banner-content text-center">
                    <h2 class="page-banner-title">{{ $galleryItem->title }}</h2>
                    <div class="page-banner-breadcrumb">
                        <p><a href="{{ route('home') }}">Home</a> <a href="{{ route('gallery.index') }}">Gallery</a> {{ $galleryItem->title }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<section id="portfolio" class="section-padding">
    <div class="auto-container">
        <div class="row">
            <div class="col-lg-7 col-md-7 col-12 mx-auto text-center">
                <div class="section-title">
                    <h2>{{ $galleryItem->title }}</h2>
                    <p>{{ $galleryItem->category }}</p>
                    <img class="img-fluid" src="{{ asset('storage/' . $galleryItem->image) }}" alt="{{ $galleryItem->title }}" />
                    <p>{{ $galleryItem->description }}</p>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
