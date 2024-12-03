@extends('layouts.app') 

@section('title', 'Gallery') 

@section('content')
<!DOCTYPE html>
<html lang="en">

<head>
   <!--Meta Tags-->
   <meta charset="utf-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1">
   <meta name="description" content="" />
   <meta name="keywords" content="" />

   <!--Favicons-->
   <link rel="shortcut icon" type="image/x-icon" href="{{asset('img/favicon.ico') }}" />

   <!--Page Title-->
   <title>KURAW - Gallery</title>

   <!-- Bootstrap core CSS -->
   <link href="{{ asset('assets/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
   <!-- Google Fonts -->
   <link
      href="https://fonts.googleapis.com/css?family=Dosis:300,400,500,600,700,800|Roboto:300,400,400i,500,500i,700,700i,900,900i"
      rel="stylesheet">
   <!-- Font Awesome -->
   <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
   <!-- Meanmenu CSS -->
   <link rel="stylesheet" href="{{ asset('assets/css/meanmenu.min.css') }}">
   <!-- Owl Carousel CSS -->
   <link rel="stylesheet" href="{{ asset('assets/owlcarousel/css/owl.carousel.min.css') }}">
   <link rel="stylesheet" href="{{ asset('assets/owlcarousel/css/owl.theme.default.min.css') }}">
   <!-- Animate CSS -->
   <link rel="stylesheet" href="{{ asset('assets/css/animate.css') }}">
   <!-- Venobox -->
   <link rel="stylesheet" href="{{ asset('assets/venobox/css/venobox.min.css') }}" />
   <!-- Style CSS -->
   <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
   <!-- Responsive CSS -->
   <link rel="stylesheet" href="{{ asset('assets/css/responsive.css') }}">
</head>

<body>
   <!-- START PRELOADER -->
   <div id="page-preloader">
      <div class="loader"></div>
      <div class="loa-shadow"></div>
   </div>
   <!-- END PRELOADER -->

    <!-- START PAGE BANNER -->
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
    <!-- END PAGE BANNER -->

    <!-- START PORTFOLIO SECTION -->
    <section id="portfolio" class="section-padding">
        <div class="auto-container">
            <div class="row">
                <div class="col-lg-7 col-md-7 col-12 mx-auto text-center">
                    <div class="section-title">
                        <h2>Image Gallery</h2>
                        <p>
                            Explore the heart of Kuraw Coffee Shop through our Image Gallery, showcasing our cozy ambiance,
                            premium coffee creations, and the memorable moments shared with our customers. From our
                            signature drinks to snapshots of events and milestones, each photo captures the essence of our
                            passion for coffee and connection.
                        </p>
                    </div>
                </div>
            </div>
            <!-- End Section Title -->

            <div class="row mb-5">
                <div class="col-12 mx-auto text-center wow fadeInDown">
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
            <!-- End Portfolio Menu List -->

            <!-- START DYNAMIC IMAGE GALLERY -->
            <div class="row project-list">
                @foreach ($galleryImages as $image)
                    <div class="col-lg-4 col-md-6 col-12 mb-lg-4 mb-md-4 mb-4 {{ $image['category'] }}">
                        <figure class="portfolio-sin-item">
                            <img class="img-fluid" src="{{ asset($image['src']) }}" alt="{{ $image['alt'] }}" />
                            <figcaption>
                                <div class="port-icon mt-3">
                                    <a class="icon-ho venobox" href="{{ asset($image['src']) }}" data-gall="gall1">
                                        <i class="icofont-eye"></i>
                                    </a>
                                </div>
                            </figcaption>
                        </figure>
                    </div>
                @endforeach
            </div>
            <!-- END DYNAMIC IMAGE GALLERY -->
        </div>
    </section>
    <!-- END PORTFOLIO SECTION -->
</body>

</html>
@endsection