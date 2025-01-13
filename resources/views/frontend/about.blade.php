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

   <!-- START PAGE BREADCRUMBS -->
   <div class="page-banner page-banner-overlay" style="background-image: url('{{ asset('assets/img/white.png') }}');">
      <div class="container h-100">
         <div class="row h-100">
            <div class="col-lg-12 my-auto">
               <div class="page-banner-content text-center">
                  <h2 class="page-banner-title">About Us</h2>
                  </div>
               </div>
            </div>
         </div>
      </div>
      <div class="page-banner-shape"></div>
   </div>
   <!-- END PAGE BREADCRUMBS -->

   <!-- START ABOUT PAGE WELCOME SECTION -->
   <section id="pabout" class="about-wel-padding">
      <div class="container">
         <div class="row">
            <!-- Image -->
            <div class="col-lg-6 col-md-6 mb-5">
               <img class="img-fluid" src="{{ asset('assets/img/kuraw/day.jpg') }}" alt="Kuraw Coffee Shop Day">
            </div>
            <!-- Text Content -->
            <div class="col-lg-6 col-md-6">
               <div class="welcome-section-title">
                  <h6 class="theme-color">Welcome To</h6>
                  <h2>Kuraw Coffee Shop</h2>
                  <p>
                     Kuraw Coffee Shop, a micro, small, and medium-sized enterprise (MSME), was established on March 8,
                     2024, as a sole proprietorship owned by Sir Rolan Lutrania. Despite its sole proprietorship status,
                     the business is collaboratively managed with Sir William, showcasing a shared passion for
                     delivering exceptional coffee and service.
                  </p>
                  <p>
                     Situated in a cozy residential area in Capsinon, Kauswagan, Cagayan de Oro City, the shop provides
                     a welcoming ambiance for customers. While space and parking are limited, the shop accommodates
                     reservations for meetings, ensuring a personalized and convenient experience.
                  </p>
               </div>
            </div>
         </div>
      </div>
   </section>
   <!-- END ABOUT PAGE WELCOME SECTION -->

   <!-- START MEET THE OWNERS SECTION -->
   <section class="py-5">
      <div class="container">
         <div class="row">
            <div class="col-lg-6">
               <div class="welcome-section-title">
                  <h2>Meet The Owners</h2>
                  <p>
                     Kuraw Coffee Shop is proudly owned and operated by Sir Rolan Lutrania, whose passion for coffee and
                     entrepreneurship brought the shop to life. While officially registered under his name, the business
                     flourishes through the dedicated partnership of Sir William Gaabucayan.
                  </p>
                  <p>
                     Together, they share a vision of creating a welcoming space where every customer can enjoy
                     exceptional coffee experiences and outstanding service. Their partnership ensures the shop meets
                     the highest standards and remains a cherished community hub.
                  </p>
               </div>
            </div>
            <div class="col-lg-6">
               <img class="img-fluid" src="{{ asset('assets/img/kuraw/owners.jpg') }}" alt="Owners">
            </div>
         </div>
      </div>
   </section>
   <!-- END MEET THE OWNERS SECTION -->

   <!-- START SERVICES TAB SECTION -->
   <section id="servicetab" class="section-padding">
      <div class="container">
         <div class="section-title text-center mb-5">
            <h2>Our Services</h2>
            <p>At Kuraw Coffee Shop, we offer a range of services to cater to your needs:</p>
         </div>
         <div class="row">
   <div class="col-lg-3">
      <ul id="tabsJustified" class="nav nav-tabs flex-column">
         <li class="nav-item">
            <a href="#one" data-toggle="tab" class="nav-link">Deliveries</a>
         </li>
         <li class="nav-item">
            <a href="#two" data-toggle="tab" class="nav-link active">Meeting Reservations</a>
         </li>
         <li class="nav-item">
            <a href="#three" data-toggle="tab" class="nav-link">Dine-in Services</a>
         </li>
      </ul>
   </div>
   <div class="col-lg-9">
      <div class="tab-content">
         <!-- Deliveries -->
         <div id="one" class="tab-pane fade">
            <div class="row">
               <div class="col-md-6">
                  <h4>Deliveries</h4>
                  <p>Enjoy the taste of Kuraw Coffee Shop from the comfort of your home or office. We offer
                     convenient delivery services for our coffee, beverages, and snacks.
                  </p>
               </div>
               <div class="col-md-6">
                  <img class="img-fluid" src="{{ asset('assets/img/service/delivery.jpg') }}" alt="Deliveries">
               </div>
            </div>
         </div>
         <!-- Meeting Reservations -->
         <div id="two" class="tab-pane fade show active">
            <div class="row">
               <div class="col-md-6">
                  <h4>Meeting Reservations</h4>
                  <p>Host your small meetings or gatherings in our cozy space. We provide a welcoming
                     environment perfect for productive discussions or intimate celebrations.
                  </p>
               </div>
               <div class="col-md-6">
                  <img class="img-fluid" src="{{ asset('assets/img/service/meeting.jpg') }}" alt="Meetings">
               </div>
            </div>
         </div>
         <!-- Dine-in Services -->
         <div id="three" class="tab-pane fade">
            <div class="row">
               <div class="col-md-6">
                  <h4>Dine-in Services</h4>
                  <p>Relax and savor our menu in the inviting atmosphere of Kuraw Coffee Shop. From signature
                     coffee to delicious snacks, we provide a delightful dine-in experience.
                  </p>
               </div>
               <div class="col-md-6">
                  <img class="img-fluid" src="{{ asset('assets/img/service/dinein.jpg') }}" alt="Dine-In">
               </div>
            </div>
         </div>
      </div>
   </div>
</div>
   </section>
   <!-- END SERVICES TAB SECTION -->

   <style>
   /* Style for active tab */
   .nav-tabs .nav-link.active {
      background-color: black; /* Black background for active tab */
      color: white !important; /* White text for active tab */
   }

   /* Style for other tabs */
   .nav-tabs .nav-link {
      color: #6c757d; /* Default Bootstrap gray text */
   }

   .nav-tabs .nav-link:hover {
      color: black; /* Black text on hover */
   }
</style>


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