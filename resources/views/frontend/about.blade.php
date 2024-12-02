@extends('layouts.app')

@section('title', 'About Us')

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
   <title>KURAW - About Us</title>

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

   <!-- START PAGEBREDCUMS -->
   <div class="page-banner page-banner-overlay" data-background="{{ asset('/assets/img/white.png') }}">
      <div class="container h-100">
         <div class="row h-100">
            <div class="col-lg-12 my-auto">
               <div class="page-banner-content text-center">
                  <h2 class="page-banner-title">About Us</h2>
                  <div class="page-banner-breadcrumb">
                     <p><a href="{{ url('/') }}">Home</a> About</p>
                  </div>
               </div>
            </div>
         </div>
      </div>
      <div class="page-banner-shape"></div>
   </div>
   <!-- END PAGEBREDCUMS -->

   <!-- START ABOUT PAGE WELCOME SECTION -->
   <section id="pabout" class="about-wel-padding">
      <div class="auto-container">
         <div class="row">
            <div class="col-lg-6 col-md-6 col-sm-12 col-12 mb-lg-0 mb-lg-0 mb-5">
               <img class="img-fluid" src="{{ asset('assets/img/kuraw/day.jpg') }}" alt="">
            </div>
            <!-- end col -->
            <div class="col-lg-6 col-md-6 col-sm-12 col-12">
               <div class="welcome-section-title">
                  <h6 class="theme-color">Welcome To</h6>
                  <h2>Kuraw Coffee Shop</h2>
                  <p>
                     Kuraw Coffee Shop, a micro, small, and medium-sized enterprise (MSME), was established on
                     March 8, 2024, as a sole proprietorship owned by Sir Rolan Lutrania. Despite its sole
                     proprietorship status, the business is collaboratively managed with Sir William, showcasing
                     a shared passion for delivering exceptional coffee and service. Situated in a cozy
                     residential area in Capsinon, Kauswagan, Cagayan de Oro City, the shop provides a welcoming
                     ambiance for customers. While space and parking are limited, the shop accommodates
                     reservations for meetings, ensuring a personalized and convenient experience.<br>
                  </p>
               </div>
            </div>
            <!-- end col -->
         </div>
      </div>
   </section>
   <!-- END ABOUT PAGE WELCOME SECTION -->

   <!-- Latest jQuery -->
   <script src="{{ asset('assets/bootstrap/js/bootstrap.min.js') }}"></script>
   <script src="{{ asset('assets/bootstrap/js/popper.min.js') }}"></script>
   <script src="{{ asset('assets/bootstrap/js/bootstrap.min.js') }}"></script>
   <script src="{{ asset('assets/js/form-contact.js') }}"></script>
   <script src="{{ asset('assets/js/isotope.3.0.6.min.js') }}"></script>
   <script src="{{ asset('assets/js/jquery-2.2.4.min.js') }}"></script>
   <script src="{{ asset('assets/js/jquery.appear.js') }}"></script>
   <script src="{{ asset('assets/js/jquery.inview.min.js') }}"></script>
   <script src="{{ asset('assets/js/jquery.meanmenu.js') }}"></script>
   <script src="{{ asset('assets/js/jquery.sticky.js') }}"></script>
   <script src="{{ asset('assets/js/main.js') }}"></script>
   <script src="{{ asset('assets/js/modal.js') }}"></script>
   <script src="{{ asset('assets/js/order-summary.js') }}"></script>
   <script src="{{ asset('assets/js/ordermodal.js') }}"></script>
   <script src="{{ asset('assets/js/proceed.js') }}"></script>
   <script src="{{ asset('assets/js/redirectorder.js') }}"></script>
   <script src="{{ asset('assets/owlcarousel/js/owl.carousel.min.js') }}"></script>
   <script src="{{ asset('assets/js/scripts.js') }}"></script>
   <script src="{{ asset('assets/js/scrolltopcontrol.js') }}"></script>
   <script src="{{ asset('assets/venobox/js/venobox.min.js') }}"></script>
   <script src="{{ asset('assets/js/wow.min.js') }}"></script>
</body>

</html>
@endsection