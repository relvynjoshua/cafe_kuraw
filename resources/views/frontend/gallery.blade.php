@extends('layouts.app')

@section('title', 'Gallery')

@section('content')
<!-- START PAGEBREADCRUMBS -->
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
    <div class="page-banner-shape"></div>
</div>
<!-- END PAGEBREADCRUMBS -->

<!-- START PORTFOLIO SECTION -->
<section id="portfolio" class="section-padding">
    <div class="auto-container">
        <div class="row">
            <div class="col-lg-7 col-md-7 col-12 mx-auto text-center">
                <div class="section-title">
                    <h2>Image Gallery</h2>
                    <p>Explore the heart of Kuraw Coffee Shop...</p>
                </div>
            </div>
        </div>

        <!-- Portfolio Filter Menu -->
        <div class="row mb-5">
            <div class="col-12 mx-auto text-center">
                <div class="portfolio-filter-menu">
                    <ul>
                        <li class="filter active" data-filter="*">All</li>
                        <li class="filter" data-filter=".one">Meetings & Small Gatherings</li>
                        <li class="filter" data-filter=".two">Best Moments</li>
                        <li class="filter" data-filter=".three">Location</li>
                    </ul>
                </div>
            </div>
        </div>

            <!-- Portfolio Items -->
            <div class="row project-list">
    @foreach ($images as $image)
        <div class="col-lg-4 col-md-6 col-12 mb-4 {{ $image['category'] }}">
            <figure class="portfolio-sin-item">
                <!-- Updated asset path -->
                <img class="img-fluid" src="{{ asset('assets/img/' . $image['src']) }}" alt="{{ $image['alt'] }}" />
                <figcaption>
                    <div class="port-icon mt-3">
                        <a class="icon-ho venobox" href="{{ asset('assets/img/' . $image['src']) }}" data-gall="gall1">
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
<!-- END PORTFOLIO SECTION -->
@endsection

@section('scripts')
    <script>
       $(document).ready(function() {
    // Filter portfolio items
    $('.portfolio-filter-menu .filter').on('click', function() {
        var filterValue = $(this).attr('data-filter'); // Get filter value
        $('.portfolio-filter-menu .filter').removeClass('active');
        $(this).addClass('active');

        if (filterValue === '*') {
            // Show all items
            $('.project-list .mb-4').show();
        } else {
            // Show only matching items, hide others
            $('.project-list .mb-4').hide();
            $(filterValue).show();
        }
    });
});

    </script>
@endsection