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
   <title>NMFIC - Mock Website</title>

   <link href="{{ asset('css/animate.css') }}" rel="stylesheet">
   <link href="{{ asset('css/app.css') }}" rel="stylesheet">
   <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">
   <link href="{{ asset('css/icofont.min.css') }}" rel="stylesheet">
   <link href="{{ asset('css/meanmenu.min.css') }}" rel="stylesheet">
   <link href="{{ asset('css/owl.carousel.min.css') }}" rel="stylesheet">
   <link href="{{ asset('css/owl.theme.default.min.css') }}" rel="stylesheet">
   <link href="{{ asset('css/responsive.css') }}" rel="stylesheet">
   <link href="{{ asset('css/style.css') }}" rel="stylesheet">
   <link href="{{ asset('css/venobox.min.css') }}" rel="stylesheet">
</head>

<body>

   <!-- START PRELOADER -->
   <div id="page-preloader">
      <div class="loader"></div>
      <div class="loa-shadow"></div>
   </div>
   <!-- END PRELOADER -->

   <!-- START HEADER SECTION -->
   <header class="main-header">
      <!-- START NAVIGATION AREA -->
      <div class="sticky-menu">
         <div class="mainmenu-area">
            <div class="auto-container">
               <div class="row">
                  <div class="col-lg-9 d-none d-lg-block d-md-none">
                     <nav class="navbar navbar-expand-lg justify-content-left">
                        <ul class="navbar-nav">
                           <li><a href="{{ url('/') }}" class="nav-link">Home</a></li>
                           <li class="active"><a href="{{ url('/about') }}" class="nav-link">About Us</a></li>
                           <li class="dropdown"><a class="nav-link" href="{{ url('/services') }}">Services</a>
                              <ul class="dropdown-menu">
                                 <li><a href="{{ url('/documents') }}">Documents</a></li>
                                 <li><a href="{{ url('/form-page') }}">Forms</a></li>
                                 <li><a href="{{ url('/single-service') }}">Facilities</a></li>
                              </ul>
                           </li>
                           <li><a href="{{ url('/gallery') }}" class="nav-link">Gallery</a></li>
                           <li class="dropdown"><a class="nav-link" href="#">Pages</a>
                              <ul class="dropdown-menu">
                                 <li><a href="{{ url('/administration') }}">Administration</a></li>
                                 <li><a href="{{ url('/') }}">FAQ</a></li>
                              </ul>
                           </li>
                           <li><a href="{{ url('/news') }}" class="nav-link">News</a></li>
                           <li><a href="{{ url('/contact') }}" class="nav-link">Contact</a></li>
                           <li><a href="{{ url('/sign-in-up') }}" class="nav-link">Login</a></li>
                        </ul>
                     </nav>
                  </div>
                  <div class="col-lg-3 d-none d-lg-block d-md-none text-right">
                     <a href="#" class="header-search" data-toggle="modal" data-target=".header-search-modal"><i
                           class="icofont-search-2"></i></a>
                  </div>

                  <!-- search modal -->
                  <div class="modal fade header-search-modal" tabindex="-1" role="dialog">
                     <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                           <div class="modal-body">
                              <button type="button" class="close" data-dismiss="modal"><i
                                    class="icofont-close-line"></i></button>
                              <form class="header-search-box">
                                 <div class="header-search-body row no-gutters align-items-center">
                                    <div class="col">
                                       <input class="form-control form-control-lg form-control" type="search"
                                          placeholder="Search...">
                                    </div>
                                    <div class="col-auto">
                                       <button class="btn btn-lg header-search-btn" type="submit"><i
                                             class="icofont-search-2"></i></button>
                                    </div>
                                 </div>
                              </form>
                           </div>
                        </div>
                     </div>
                  </div>
                  <!-- end search modal -->

               </div>
            </div>
         </div>
      </div>
      <!-- END NAVIGATION AREA -->

      <!-- START LOGO AREA -->
      <div class="logo-area">
         <div class="auto-container">
            <div class="row">
               <div class="col-lg-3 col-12 mx-auto text-lg-left text-center pl-0 mb-lg-0 mb-4">
                  <div class="logo">
                     <a href="{{ url('/') }}">
                        <img class="img-fluid" src="{{ asset('/img/fic.jpg') }}" alt="">
                     </a>
                  </div>
               </div>
               <!-- end col -->
               <div class="col-lg-9 col-12">
                  <div class="header-info-box">
                     <div class="header-info-icon">
                        <i class="icofont-envelope"></i>
                     </div>
                     <h5>Connect With Us</h5>
                     <p>ustp.fic.edu.ph</p>
                  </div>
                  <div class="header-info-box">
                     <div class="header-info-icon">
                        <i class="icofont-headphone-alt-3"></i>
                     </div>
                     <h5>Call For Inquiry</h5>
                     <p>123-456-789</p>
                  </div>
                  <div class="header-info-box">
                     <div class="header-info-icon">
                        <i class="icofont-eye-open"></i>
                     </div>
                     <h5>Opening hours</h5>
                     <p>Mon - Fri : 09:00 - 16:00</p>
                  </div>
               </div>
               <!-- end col -->
            </div>
         </div>
      </div>
      <!-- END LOGO AREA -->

      <!-- START TOP AREA -->
      <div class="top-area">
         <div class="auto-container">
            <div class="row">
               <div class="col-lg-4 col-md-12 col-sm-12 col-12 text-lg-left text-center">
                  <div class="header-social">
                     <ul>
                        <li><a href="#"><i class="icofont-facebook"></i></a></li>
                        <li><a href="#"><i class="icofont-twitter"></i></a></li>
                        <li><a href="#"><i class="icofont-youtube"></i></a></li>
                     </ul>
                  </div>
               </div>
               <!-- end col -->
               <div class="col-lg-8 col-md-12 col-sm-12 col-12 text-lg-right text-center">
                  <div class="top-menu">
                     <ul>
                        <li><a href="#"><i class="icofont-location-pin"></i>Claro M. Recto Avenue, Lapasan 9000 Cagayan
                              de Oro City, Philippines</a></li>
                        <li><a href="#"><i class="icofont-phone"></i>088-856-1738</a></li>
                     </ul>
                  </div>
               </div>
               <!-- end col -->
            </div>
         </div>
      </div>
      <!-- END TOP AREA -->
   </header>
   <!-- END HEADER SECTION -->

   <!-- START PAGEBREDCUMS -->
   <div class="page-banner page-banner-overlay" data-background="{{ asset('/img/bldg/bldg1_night.jpg') }}">
      <div class="container h-100">
         <div class="row h-100">
            <div class="col-lg-12 my-auto">
               <div class="page-banner-content text-center">
                  <h2 class="page-banner-title">About Us</h2>
                  <div class="page-banner-breadcrumb">
                     <p><a href="#">Home</a> About</p>
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
               <img class="img-fluid" src="{{ asset('assets/img/bldg/bldg2.JPG') }}" alt="" />
            </div>
            <!-- end col -->
            <div class="col-lg-6 col-md-6 col-sm-12 col-12">
               <div class="welcome-section-title">
                  <h6 class="theme-color">Welcome To</h6>
                  <h2>Kuraw Coffee Shop </h2>
                  <p>The Kuraw Coffee Shop  a micro, small, and medium-sized enterprise, 
                     was established on March 8, 2024, as a sole proprietorship by Sir Rolan Lutrania. 
                     However, the business was operated in partnership with Sir William. 
                     The concept for this business emerged during a pandemic, and the name "Kuraw," 
                     which means "mix" in Visayan.<br></p>
               </div>
               <div class="welcome-des wow fadeInUp">
                  <div class="col-lg-8 col-md-7 col-12 pl-0 mt-4">
                     <div class="row">
                        <div class="col-lg-6 mb-md-3 mb-3">
                           <div class="welcome-btn">
                              <a href="#" class="welcome-into-btn">Learn More <i
                                    class="icofont icofont-caret-right"></i></a>
                           </div>
                        </div>
                        <div class="col-lg-6">
                           <a class="welcome-video venobox" data-autoplay="true" data-vbtype="video"
                              data-title="Introduction Video" data-gall="videoa"
                              href="https://youtube.com/watch?v=-qUBenfVw7E">
                              <div class="welcome-video-icon">
                                 <i class="icofont-youtube-play"></i>
                              </div>
                              <div class="welcome-video-des">
                                 <h5>Watch Video</h5>
                                 <p>About Us</p>
                              </div>
                           </a>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
            <!-- end col -->
         </div>
      </div>
   </section>
   <!-- END ABOUT PAGE WELCOME SECTION -->

   <!-- START COUNTER SECTION -->
   <section id="counter" class="counter-section counter-padding overlay section-back-image"
      data-background="{{ asset('/img/bldg/bldg2') }}.jpg">
      <div class="auto-container">
         <div class="row text-center wow fadeInUp">
            <div class="col-lg-3 col-md-3 col-12 mb-lg-0 mb-md-0 mb-4">
               <div class="single-counter-item single-counter-item-s-2">
                  <i class="icofont-book"></i>
                  <h4 class="timer">121</h4>
                  <p>Satisfied Customers</p>
               </div>
            </div>
            <!-- End single counter item -->
            <div class="col-lg-3 col-md-3 col-12 mb-lg-0 mb-md-0 mb-4">
               <div class="single-counter-item single-counter-item-s-2">
                  <i class="icofont-light-bulb"></i>
                  <h4 class="timer">342</h4>
                  <p>Successful Events</p>
               </div>
            </div>
            <!-- End single counter item -->
   </section>
   <!-- END COUNTER SECTION -->


   <!-- START SERVICE TAB SECTION -->
   <section id="servicetab" class="section-padding">
      <div class="auto-container">
         <div class="row">
            <div class="col-lg-7 col-md-7 col-12 mx-auto text-center">
               <div class="section-title">
                  <h6 class="theme-color">What We Do</h6>
                  <h2>Services We Provide</h2>
                  <p>At Kuraw Coffee Shop, we blend quality coffee with a cozy ambiance,
                      creating a space for relaxation, connection, and productivity.
                      Our mission is to offer not only the finest brews but also a 
                      welcoming environment where friends, families, and colleagues
                      can come together. Whether you're stopping by for a quick coffee,
                      looking for a comfortable spot to work, or hosting a gathering,
                      we're here to make your time memorable.</p>
               </div>
            </div>
         </div>
         <!-- end section title -->
         <div class="service-tab">
            <div class="row">
               <div class="col-lg-3 col-12 mb-lg-0 mb-md-4 mb-4">
                  <ul id="tabsJustified" class="nav nav-tabs">
                     <li class="nav-item">
                        <a href="#" data-target="#one" data-toggle="tab" class="nav-link">
                           <span>Meeting Reservations</span>
                        </a>
                     </li>
                     <li class="nav-item">
                        <a href="#" data-target="#two" data-toggle="tab" class="nav-link active">
                           <span>Food Reservations</span>
                        </a>
                     </li>
                     <li class="nav-item">
                        <a href="#" data-target="#three" data-toggle="tab" class="nav-link">
                           <span>Deliveries</span>
                        </a>
                     </li>
                  </ul>
               </div>
               <!-- end col -->
               <div class="col-lg-9 col-md-12 col-sm-12 col-xs-12">
                  <div id="tabsJustifiedContent" class="tab-content">
                     <div id="one" class="tab-pane animated fadeInUp">
                        <div class="auto-container">
                           <div class="row">
                              <div class="col-lg-6 col-md-6 col-12 mb-lg-0 mb-md-0 mb-5 text-lg-right text-left">
                                 <div class="service-tab-left">
                                    <h4>Meeting Reservations</h4>
                                    <p>Our coffee shop offers a calm and productive setting for meetings. 
                                       Reserve a spot with us to host small business gatherings, 
                                       casual catch-ups, or study sessions, and let us handle the rest.</p>
                                 </div>
                              </div>
                              <!-- end col -->
                              <div class="col-lg-6 col-md-6 col-12 pl-lg-5 pl-0">
                                 <div class="ab-img-col">
                                    <figure>
                                       <img class="img-fluid" src="{{ asset('assets/img/service/6.jpg') }}" alt="">
                                    </figure>
                                 </div>
                              </div>
                              <!-- end col -->
                           </div>
                        </div>
                     </div>
                     <div id="two" class="tab-pane animated fadeInUp active show">
                        <div class="auto-container">
                           <div class="row">
                              <div class="col-lg-6 col-md-6 col-12 mb-lg-0 mb-md-0 mb-5 text-lg-right text-left">
                                 <div class="service-tab-left">
                                    <h4>Food Reservations</h4>
                                    <p>For those planning a special occasion or a casual meetup, you can reserve meals in advance. 
                                       We make it easy to enjoy a great meal without the wait.</p>
                                 </div>
                              </div>
                              <!-- end col -->
                              <div class="col-lg-6 col-md-6 col-12 pl-lg-5 pl-0">
                                 <div class="ab-img-col">
                                    <figure>
                                       <img class="img-fluid" src="{{ asset('assets/img/service/2.jpg') }}" alt="">
                                    </figure>
                                 </div>
                              </div>
                              <!-- end col -->
                           </div>
                        </div>
                     </div>
                     <div id="three" class="tab-pane animated fadeInUp">
                        <div class="auto-container">
                           <div class="row">
                              <div class="col-lg-6 col-md-6 col-12 mb-lg-0 mb-md-0 mb-5 text-lg-right text-left">
                                 <div class="service-tab-left">
                                    <h4>Deliveries</h4>
                                    <p>Get your favorite coffee and treats delivered right to your door! Perfect for
                                        enjoying Kuraw’s quality coffee and menu items from the comfort 
                                        of your home or office.</p>
                                 </div>
                              </div>
                              <!-- end col -->
         </div>
      </div>
      </div>
      <!--- END CONTAINER -->
   </section>
   <!-- END SERVICE TAB SECTION -->


   <!-- START ABOUT TESTIMONIAL SECTION -->
   <section id="aboutes" class="section-padding bg-gray">
      <div class="auto-container">
         <div class="row">
            <div class="col-lg-7 col-md-7 col-12 mx-auto text-center">
               <div class="section-title">
                  <h6 class="theme-color">Believe in Satisfaction</h6>
                  <h2>...</h2>
                  <p>.......</p>
               </div>
            </div>
         </div>
         <!-- end section title -->
         <div class="row">
            <div class="col-lg-6 col-md-6 col-12 mb-lg-0 mb-md-0 mb-4 wow fadeInLeft">
               <div class="testimonial-style-2">
                  <div class="testimonial-style-2-left">
                     <img class="testimonial-thumb rounded-circle" src="{{ asset('assets/img/testimonial/maloi.jpg') }}"
                        alt="">
                     <h4>Maloi</h4>
                     <span>BPO Worker</span>
                  </div>
                  <div class="testimonial-style-2-right rounded">
                     <p>Pellentesque Sed ut perspiciatis unde omnis iste natus error sitre voluptatem accusantium udema
                        doloremque laudantium, totarmd aperiam, eaque ipsa quae ab illa inventore veritati.</p>
                  </div>
               </div>
            </div>
            <!-- end col -->
            <div class="col-lg-6 col-md-6 col-12 wow fadeInRight">
               <div class="testimonial-style-2">
                  <div class="testimonial-style-2-left">
                     <img class="testimonial-thumb rounded-circle" src="{{ asset('assets/img/testimonial/maki.png') }}"
                        alt="">
                     <h4>Maki</h4>
                     <span>Student</span>
                  </div>
                  <div class="testimonial-style-2-right rounded">
                     <p>Pellentesque Sed ut perspiciatis unde omnis iste natus error sitre voluptatem accusantium udema
                        doloremque laudantium, totarmd aperiam, eaque ipsa quae ab illa inventore veritati.</p>
                  </div>
               </div>
            </div>
            <!-- end col -->
         </div>
      </div>
   </section>
   <!-- END ABOUT TESTIMONIAL SECTION -->


            </div>
         </div>
      </section>
      <!-- END ABOUT PAGE WELCOME SECTION -->

      <!-- START COUNTER SECTION -->
      <section id="counter" class="counter-section counter-padding overlay section-back-image" data-background="{{ asset('/img/bldg/bldg2') }}.jpg">
         <div class="auto-container">
            <div class="row text-center wow fadeInUp">
               <div class="col-lg-3 col-md-3 col-12 mb-lg-0 mb-md-0 mb-4">
                  <div class="single-counter-item single-counter-item-s-2">
                     <i class="icofont-book"></i>
                     <h4 class="timer">121</h4>
                     <p>Research Studies</p>
                  </div>
               </div>
               <!-- end col -->
               <div class="col-lg-3 col-md-6 col-sm-12 col-12 mb-lg-0 mb-md-0 mb-sm-5 mb-5">
                  <div class="footer-widget-title col-12 p-0">
                     <h4>Useful Links</h4>
                  </div>
                  <div class="footer-widget-inner">
                     <ul>
                        <li><a href="{{ url('/documents') }}"><i class="icofont-circled-right"></i> Documents</a></li>
                        <li><a href="{{ url('/services') }}"><i class="icofont-circled-right"></i> Latest Services</a>
                        </li>
                        <li><a href="{{ url('/administration') }}"><i class="icofont-circled-right"></i>
                              Administration</a></li>
                        <li><a href="{{ url('/gallery') }}"><i class="icofont-circled-right"></i> Image Gallery</a></li>
                        <li><a href="{{ url('/') }}"><i class="icofont-circled-right"></i> FAQs</a></li>
                     </ul>
                  </div>
               </div>
               <!-- end col -->
               <div class="col-lg-3 col-md-6 col-sm-12 col-12 mb-lg-0 mb-md-0 mb-sm-0 mb-0">
                  <div class="footer-widget-title col-12 p-0">
                     <h4>Get In Touch</h4>
                  </div>
                  <div class="footer-widget-inner">
                     <div class="footer-contact-widget">
                        <div class="footer-contact-sin">
                           <div class="footer-contact-sin-left">
                              <i class="icofont-pin"></i>
                           </div>
                           <div class="footer-contact-sin-right">
                              <p>Claro M. Recto Ave, Cagayan de Oro</p>
                           </div>
                        </div>
                        <div class="footer-contact-sin">
                           <div class="footer-contact-sin-left">
                              <i class="icofont-smart-phone"></i>
                           </div>
                           <div class="footer-contact-sin-right">
                              <p>+639667811333</p>
                           </div>
                        </div>
                        <div class="footer-contact-sin">
                           <div class="footer-contact-sin-left">
                              <i class="icofont-envelope"></i>
                           </div>
                           <div class="footer-contact-sin-right">
                              <p>ustp.fic.edu.ph</p>
                           </div>
                        </div>
                        <div class="footer-contact-sin">
                           <div class="footer-contact-sin-left">
                              <i class="icofont-clock-time"></i>
                           </div>
                           <div class="footer-contact-sin-right">
                              <p>Mon - Fri : 08:00 - 05:00</p>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
               <!-- end col -->
            </div>
         </div>
      </div>
      <div id="bottom-footer" class="bg-gray">
         <div class="auto-container">
            <div class="row mb-lg-0 mb-md-4 mb-4">
               <div class="col-lg-6 col-md-12 col-12">
                  <p class="copyright-text">Copyright © 2024 <a href="#">USTP - FIC</a> | All Rights Reserved</p>
               </div>
               <!-- end col -->
               <div class="col-lg-6 col-md-12 col-12">
                  <div class="footer-menu">
                     <ul>
                        <li><a href="{{ url('/index') }}">Home</a></li>
                        <li><a href="{{ url('/about') }}">About Us</a></li>
                        <li><a href="{{ url('/contact') }}">Contact Us</a></li>
                        <li><a href="#">Privacy Policy</a></li>
                     </ul>
                  </div>
               </div>
               <!-- end col -->
            </div>
         </div>
      </div>
   </footer>
   <!-- END FOOTER -->

   <!-- Latest jQuery -->
   <script src="{{ asset('js/app.js') }}"></script>
   <script src="{{ asset('js/bootstrap.min.js') }}"></script>
   <script src="{{ asset('js/bootstrap.js') }}"></script>
   <script src="{{ asset('js/form-contact.js') }}"></script>
   <script src="{{ asset('js/isotope.3.0.6.min.js') }}"></script>
   <script src="{{ asset('js/jquery-2.2.4.min.js') }}"></script>
   <script src="{{ asset('js/jquery.appear.js') }}"></script>
   <script src="{{ asset('js/jquery.inview.min.js') }}"></script>
   <script src="{{ asset('js/jquery.meanmenu.js') }}"></script>
   <script src="{{ asset('js/jquery.sticky.js') }}"></script>
   <script src="{{ asset('js/main.js') }}"></script>
   <script src="{{ asset('js/owl.carousel.min.js') }}"></script>
   <script src="{{ asset('js/popper.js') }}"></script>
   <script src="{{ asset('js/scripts.js') }}"></script>
   <script src="{{ asset('js/scrolltopcontrol.js') }}"></script>
   <script src="{{ asset('js/venobox.min.js') }}"></script>
   <script src="{{ asset('js/wow.min.js') }}"></script>
</body>

      <!-- START FOOTER -->
          <footer class="footer-section">
            <div id="top-footer" class="overlay-2 section-back-image-2" data-background="{{ asset('/img/bg/fic-footer.jpg') }}">
               <div class="auto-container">
                  <div class="row">
                     <div class="col-lg-3 col-md-6 col-sm-12 col-12 mb-lg-0 mb-md-5 mb-sm-5 mb-5">
                        <div class="footer-widget-title col-12 p-0">
                           <div class="logo">
                              <a href="index.blade.php">
                                 <img class="img-fluid" src="{{ asset('assets/img/ff.png') }}" alt="">
                              </a>
                           </div>
                        </div>
                        <div class="footer-widget-inner">
                           <div class="img-menu float-lg-left float-none mt-3">
                              <div class="footer-social">
                                 <ul>
                                    <li><a class="social-fb" href="https://www.facebook.com/nmficustpcdo"><i class="icofont-facebook"></i></a></li>
                                    <li><a class="social-tw" href="#"><i class="icofont-twitter"></i></a></li>
                                    <li><a class="social-gp" href="#"><i class="icofont-youtube"></i></a></li>
                                 </ul>
                              </div>
                           </div>
                        </div>
                     </div>
                     <!-- end col -->
                     <div class="col-lg-3 col-md-6 col-sm-12 col-12 mb-lg-0 mb-md-5 mb-sm-5 mb-5">
                        <div class="footer-widget-title col-12 p-0">
                           <h4>Latest Posts</h4>
                        </div>
                        <div class="footer-widget-inner">
                           <div class="singleRecpost">
                              <img src="{{ asset('assets/img/NMFIC2.jpg') }}" alt="" class="img-fluid">
                              <h6 class="recTitle">
                                 <a href="#">USTP CDO COVID-19 Initiative</a>
                              </h6>
                              <p class="posted-on">1 APRIL 2020</p>
                           </div>
                           <div class="singleRecpost">
                              <img src="{{ asset('assets/img/NMFIC4.jpg') }}" alt="" class="img-fluid">
                              <h6 class="recTitle">
                                 <a href="#">FIC produced snacks for COVID-19 frontliners</a>
                              </h6>
                              <p class="posted-on">13 APRIL 2020</p>
                           </div>
                        </div>
                     </div>
                     <!-- end col -->
                     <div class="col-lg-3 col-md-6 col-sm-12 col-12 mb-lg-0 mb-md-0 mb-sm-5 mb-5">
                        <div class="footer-widget-title col-12 p-0">
                           <h4>Useful Links</h4>
                        </div>
                        <div class="footer-widget-inner">
                           <ul>
                              <li><a href="{{ url('/documents') }}"><i class="icofont-circled-right"></i> Documents</a></li>
                              <li><a href="{{ url('/services') }}"><i class="icofont-circled-right"></i> Latest Services</a></li>
                              <li><a href="{{ url('/administration') }}"><i class="icofont-circled-right"></i> Administration</a></li>
                              <li><a href="{{ url('/gallery') }}"><i class="icofont-circled-right"></i> Image Gallery</a></li>
                              <li><a href="{{ url('/') }}"><i class="icofont-circled-right"></i> FAQs</a></li>
                           </ul>
                        </div>
                     </div>
                     <!-- end col -->
                     <div class="col-lg-3 col-md-6 col-sm-12 col-12 mb-lg-0 mb-md-0 mb-sm-0 mb-0">
                        <div class="footer-widget-title col-12 p-0">
                           <h4>Get In Touch</h4>
                        </div>
                        <div class="footer-widget-inner">
                           <div class="footer-contact-widget">
                              <div class="footer-contact-sin">
                                 <div class="footer-contact-sin-left">
                                    <i class="icofont-pin"></i>
                                 </div>
                                 <div class="footer-contact-sin-right">
                                    <p>Claro M. Recto Ave, Cagayan de Oro</p>
                                 </div>
                              </div>
                              <div class="footer-contact-sin">
                                 <div class="footer-contact-sin-left">
                                    <i class="icofont-smart-phone"></i>
                                 </div>
                                 <div class="footer-contact-sin-right">
                                    <p>+639667811333</p>
                                 </div>
                              </div>
                              <div class="footer-contact-sin">
                                 <div class="footer-contact-sin-left">
                                    <i class="icofont-envelope"></i>
                                 </div>
                                 <div class="footer-contact-sin-right">
                                    <p>ustp.fic.edu.ph</p>
                                 </div>
                              </div>
                              <div class="footer-contact-sin">
                                 <div class="footer-contact-sin-left">
                                    <i class="icofont-clock-time"></i>
                                 </div>
                                 <div class="footer-contact-sin-right">
                                    <p>Mon - Fri : 08:00 - 05:00</p>
                                 </div>
                              </div>
                           </div>
                        </div>
                     </div>
                     <!-- end col -->
                  </div>
               </div>
            </div>
            <div id="bottom-footer" class="bg-gray">
               <div class="auto-container">
                  <div class="row mb-lg-0 mb-md-4 mb-4">
                     <div class="col-lg-6 col-md-12 col-12">
                        <p class="copyright-text">Copyright © 2024 <a href="#">USTP - FIC</a> | All Rights Reserved</p>
                     </div>
                     <!-- end col -->
                     <div class="col-lg-6 col-md-12 col-12">
                        <div class="footer-menu">
                           <ul>
                              <li><a href="{{ url('/index') }}">Home</a></li>
                              <li><a href="{{ url('/about') }}">About Us</a></li>
                              <li><a href="{{ url('/contact') }}">Contact Us</a></li>
                              <li><a href="#">Privacy Policy</a></li>
                           </ul>
                        </div>
                     </div>
                     <!-- end col -->
               </div>
            </div>
         </div>
      </footer>
      <!-- END FOOTER -->

      <!-- Latest jQuery -->
      <script src="{{ asset('js/app.js') }}"></script>
      <script src="{{ asset('js/bootstrap.min.js') }}"></script>
      <script src="{{ asset('js/bootstrap.js') }}"></script>
      <script src="{{ asset('js/form-contact.js') }}"></script>
      <script src="{{ asset('js/isotope.3.0.6.min.js') }}"></script>
      <script src="{{ asset('js/jquery-2.2.4.min.js') }}"></script>
      <script src="{{ asset('js/jquery.appear.js') }}"></script>
      <script src="{{ asset('js/jquery.inview.min.js') }}"></script>
      <script src="{{ asset('js/jquery.meanmenu.js') }}"></script>
      <script src="{{ asset('js/jquery.sticky.js') }}"></script>
      <script src="{{ asset('js/main.js') }}"></script>
      <script src="{{ asset('js/owl.carousel.min.js') }}"></script>
      <script src="{{ asset('js/popper.js') }}"></script>
      <script src="{{ asset('js/scripts.js') }}"></script>
      <script src="{{ asset('js/scrolltopcontrol.js') }}"></script>
      <script src="{{ asset('js/venobox.min.js') }}"></script>
      <script src="{{ asset('js/wow.min.js') }}"></script>
   </body>
</html>
@endsection


