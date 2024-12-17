@extends('layouts.app')

@section('title', 'Gallery')

@section('content')
<div class="page-banner page-banner-overlay" style="background-image: url('{{ asset('assets/img/white.png') }}');">
    <div class="container h-100">
        <div class="row h-100">
            <div class="col-lg-12 my-auto">
                <div class="page-banner-content text-center">
                    <h2 class="page-banner-title">Gallery</h2>
                    <div class="page-banner-breadcrumb">
                        <p><a href="{{ url('/') }}">Home</a> Gallery</p>
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
                    <h2>Gallery</h2>
                    <p>Explore the heart of Kuraw Coffee Shop...</p>
                </div>
            </div>
        </div>

        <div class="row">
            @foreach ($galleryItems as $item)
                <div class="col-lg-4 col-md-6 col-12 mb-4 {{ $item->category }}">
                    <figure class="portfolio-sin-item">
                        <img class="img-fluid" src="{{ asset('storage/' . $item->image) }}" alt="{{ $item->title }}" />
                        <figcaption>
                            <div class="port-icon mt-3">
                                <a href="{{ route('gallery.show', $item) }}" class="icon-ho">
                                    <i class="icofont-eye"></i>
                                </a>
                            </div>
                        </figcaption>
                    </figure>
                </div>
            @endforeach
        </div>
    </div>
</section>
@endsection
