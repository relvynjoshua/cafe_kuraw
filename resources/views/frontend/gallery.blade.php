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

<style>
   /* Pagination container */
   .pagination {
      display: flex;
      justify-content: center;
      align-items: center;
      margin-top: 20px;
   }

   /* Pagination list */
   .pagination ul {
      list-style-type: none;
      padding: 0;
      margin: 0;
      display: flex;
   }

   /* Pagination items */
   .pagination li {
      margin: 0 5px;
   }

   /* Pagination links */
   .pagination a {
      display: inline-block;
      padding: 6px 12px;
      /* Adjusted padding for better button size */
      color: #007bff;
      text-decoration: none;
      border: 1px solid #ddd;
      border-radius: 3px;
      background-color: #fff;
      transition: background-color 0.3s, color 0.3s;
      font-size: 1rem;
      /* Adjusted font size for page numbers */
      line-height: 1.5;
   }

   /* Hover and active state */
   .pagination a:hover,
   .pagination .active a {
      background-color: #007bff;
      color: white;
   }

   /* Disabled state */
   .pagination .disabled a {
      color: #ccc;
      pointer-events: none;
   }

   /* Arrow buttons */
   .pagination .arrow {
      font-size: 1.2rem;
      /* Make the arrows a bit bigger */
      padding: 6px 10px;
   }

   /* Arrow hover effect */
   .pagination .arrow:hover {
      background-color: #007bff;
      color: white;
   }

   /* Adjust spacing and layout for responsiveness */
   @media (max-width: 768px) {
      .pagination .page-link {
         font-size: 10px;
         /* Smaller font size on smaller screens */
         padding: 3px 6px;
         /* Adjust padding for compact display */
      }
   }
</style>

<!-- START PAGEBREADCRUMBS -->
<div class="page-banner page-banner-overlay"
   style="background-image: url('{{ asset('assets/img/white.png') }}'); height: 150px; display: flex; align-items: center; justify-content: center;">
   <div class="container text-center">
      <h2 class="page-banner-title" style="font-size: 32px; margin-bottom: 5px;">Gallery</h2>
      <div class="page-banner-breadcrumb" style="font-size: 16px;">
         <a href="{{ url('/') }}">Home</a> / Gallery
      </div>
   </div>
</div>
<!-- END PAGEBREADCRUMBS -->

<!-- START PORTFOLIO SECTION -->
<section id="portfolio" class="section-padding">
   <div class="container">
      <div class="row mb-4">
         <div class="col-lg-7 col-md-7 col-12 mx-auto text-center">
            <div class="section-title">
               <h2 style="font-size: 28px; font-weight: bold;">Image Gallery</h2>
               <p style="font-size: 18px;">Explore the heart of Kuraw Coffee Shop...</p>
            </div>
         </div>
      </div>

      <!-- Portfolio Items -->
      <div class="row project-list">
         @foreach ($images as $image)
          <div class="col-lg-4 col-md-6 col-12 mb-4">
            <figure class="portfolio-sin-item" style="border: 1px solid #eaeaea; padding: 10px; text-align: center;">
               <img class="img-fluid" src="{{ asset('assets/img/' . $image->src) }}" alt="{{ $image->alt }}"
                 style="width: 100%; height: auto; margin-bottom: 10px;">

               <!-- Image Title -->
               <figcaption>
                 <h3 style="font-size: 20px; font-weight: bold; margin-bottom: 10px;">
                   {{ $image->alt }}
                 </h3>

                 <!-- Font Awesome Icon -->
                 <a href="{{ asset('assets/img/' . $image->src) }}" class="btn btn-primary" data-toggle="tooltip"
                   title="View Image" target="_blank">
                   <i class="fas fa-eye" style="font-size: 24px;"></i>
                 </a>
               </figcaption>
            </figure>
          </div>
       @endforeach
      </div>
   </div>

   <!-- Pagination Links -->
   <div class="pagination">
      <!-- Previous arrow -->
      <a href="#" class="arrow" onclick="changePage('prev')">«</a>

      <!-- Page Numbers -->
      <span>Page {{ $images->currentPage() }} of {{ $images->lastPage() }}</span>

      <!-- Next arrow -->
      <a href="#" class="arrow" onclick="changePage('next')">»</a>
   </div>
</section>

<script>
   $(document).ready(function () {
      // Initialize tooltips for Font Awesome icons
      $('[data-toggle="tooltip"]').tooltip();
   });
</script>
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