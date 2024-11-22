@extends('layouts.app')

@section('title', 'Menu')

@section('content')
<!DOCTYPE html>
<html lang="zxx">

<head>
      <!--Meta Tags-->
      <meta charset="utf-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <meta name="description" content=""/>
      <meta name="keywords" content=""/>

      <!--Favicons-->
      <link rel="shortcut icon" type="image/x-icon" href="assets/img/favicon.ico" />

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
         <!-- START LOGO AREA -->
         <div class="logo-area">
            <div class="auto-container">
               <div class="row">
                  <div class="col-lg-3 col-12 mx-auto text-lg-left text-center pl-0 mb-lg-0 mb-4">
                     <div class="logo">
                        <a href="index.html">
                        <img class="img-fluid" src={{ asset("/img/fic.jpg")}} alt="">
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
                        <p>856-8159</p>
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
                           <li><a href="#"><i class="icofont-location-pin"></i>Claro M. Recto Avenue, Lapasan 9000 Cagayan de Oro City, Philippines</a></li>
                           <li><a href="#"><i class="icofont-phone"></i>856-8159</a></li>
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
      <div class="page-banner page-banner-overlay" data-background="assets/img/menu/cover.jpg">
         <div class="container h-100">
            <div class="row h-100">
               <div class="col-lg-12 my-auto">
                  <div class="page-banner-content text-center">
                     <h2 class="page-banner-title">Menu</h2>
                     <div class="page-banner-breadcrumb">
                        <p><a href="#">Home</a> Menu</p>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
      <!-- END PAGEBREDCUMS -->

      <!-- START PORTFOLIO PAGE SECTION -->
      <section id="galleryPage" class="section-padding">
      <div class="auto-container">
         <!-- Filter Menu -->
         <div class="row mb-5">
               <div class="col-12 mx-auto text-center">
                  <div class="portfolio-filter-menu">
                     <ul>
                           <li class="filter active" data-filter="*">All</li>
                           <li class="filter" data-filter=".one">Coffee</li>
                           <li class="filter" data-filter=".two">Non-Coffee</li>
                           <li class="filter" data-filter=".three">Tea</li>
                           <li class="filter" data-filter=".four">Fruit Soda</li>
                           <li class="filter" data-filter=".five">Food and Snacks</li>
                     </ul>
                  </div>
               </div>
         </div>            <!-- end portfolio menu list -->
            <div class="isotope-grid">

            <!-- end portfolio menu list -->

            <div class="row project-list">
               <div class="col-lg-4 col-md-6 col-12 mb-lg-4 mb-md-4 mb-4 one">
                  <figure class="service-list-item shadow">
                     <img class="img-fluid" src={{ asset("/img/menu/espresso.PNG")}} alt="" />
                     <figcaption>
                        <div class="port-icon mt-3">
                           <a class="icon-ho venobox"></i></a>
                        </div>
                        <div class="service-list-des">
                           <h4>ESPRESSO</h4>
                           <p>Lorem ipsum dolor sit amet consectetur ullamco adipiscing elit, sed do eiusmod tempor exercitat incididunt ut labore.</p>
                           <div class="price-order">
                           <h5>₱80</h5>
                           <button class="order-now-btn">ORDER NOW</button>
                           </div>
                       </div>
                     </figcaption>
                  </figure>
               </div>
               <!--  end single item -->

               <div class="col-lg-4 col-md-6 col-12 mb-lg-4 mb-md-4 mb-4 one">
                  <figure class="service-list-item shadow">
                     <img class="img-fluid" src={{ asset("/img/menu/icedamericano.jpg")}} alt="" />
                     <figcaption>
                        <div class="port-icon mt-3">
                           <a class="icon-ho venobox"></a></i></a>
                        </div>
                        <div class="service-list-des">
                           <h4>CAFE AMERICANO</h4>
                           <p>Lorem ipsum dolor sit amet consectetur ullamco adipiscing elit, sed do eiusmod tempor exercitat incididunt ut labore.</p>
                           <div class="price-order">
                           <h5>₱80</h5>
                           <button class="order-now-btn">ORDER NOW</button>
                           </div>
                       </div>
                     </figcaption>
                  </figure>
               </div>
               <!--  end single item -->

               <div class="col-lg-4 col-md-6 col-12 mb-lg-4 mb-md-4 mb-4 one">
                  <figure class="service-list-item shadow">
                     <img class="img-fluid" src={{ asset("/img/gallery/2.jpg")}} alt="" />
                     <figcaption>
                        <div class="port-icon mt-3">
                           <a class="icon-ho venobox"></i></a>
                        </div>
                        <div class="service-list-des">
                           <h4>CORTADO</h4>
                           <p>Lorem ipsum dolor sit amet consectetur ullamco adipiscing elit, sed do eiusmod tempor exercitat incididunt ut labore.</p>
                           <div class="price-order">
                           <h5>₱80</h5>
                           <button class="order-now-btn">ORDER NOW</button>
                           </div>
                       </div>
                     </figcaption>
                  </figure>
               </div>
               <!--  end single item -->

               <div class="col-lg-4 col-md-6 col-12 mb-md-4 mb-4 one">
                  <figure class="service-list-item shadow">
                     <img class="img-fluid" src={{ asset("/img/gallery/1.jpg")}} alt="" />
                     <figcaption>
                        <div class="port-icon mt-3">
                           <a class="icon-ho venobox"></i></a>
                        </div>
                        <div class="service-list-des">
                           <h4>FLAT WHITE</h4>
                           <p>Lorem ipsum dolor sit amet consectetur ullamco adipiscing elit, sed do eiusmod tempor exercitat incididunt ut labore.</p>
                           <div class="price-order">
                           <h5>₱80</h5>
                           <button class="order-now-btn">ORDER NOW</button>
                           </div>
                       </div>
                     </figcaption>
                  </figure>
               </div>
               <!--  end single item -->

               <div class="col-lg-4 col-md-6 col-12 mb-4 one">
                  <figure class="service-list-item shadow">
                     <img class="img-fluid" src={{ asset("/img/gallery/1.jpg")}} alt="" />
                     <figcaption>
                        <div class="port-icon mt-3">
                           <a class="icon-ho venobox"></i></a>
                        </div>
                        <div class="service-list-des">
                           <h4>CAPPUCCINO</h4>
                           <p>Lorem ipsum dolor sit amet consectetur ullamco adipiscing elit, sed do eiusmod tempor exercitat incididunt ut labore.</p>
                           <div class="price-order">
                           <h5>₱80</h5>
                           <button class="order-now-btn">ORDER NOW</button>
                           </div>
                       </div>
                     </figcaption>
                  </figure>
               </div>
               <!--  end single item -->

               <div class="col-lg-4 col-md-6 col-12 mb-lg-4 one">
                  <figure class="service-list-item shadow">
                     <img class="img-fluid" src={{ asset("/img/gallery/1.jpg")}} alt="" />
                     <figcaption>
                        <div class="port-icon mt-3">
                           <a class="icon-ho venobox"></i></a>
                        </div>
                        <div class="service-list-des">
                           <h4>CAFE LATTE</h4>
                           <p>Lorem ipsum dolor sit amet consectetur ullamco adipiscing elit, sed do eiusmod tempor exercitat incididunt ut labore.</p>
                           <div class="price-order">
                           <h5>₱80</h5>
                           <button class="order-now-btn">ORDER NOW</button>
                           </div>
                       </div>
                     </figcaption>
                  </figure>
               </div>
               <!--  end single item -->
               <div class="col-lg-4 col-md-6 col-12 one">
                  <figure class="service-list-item shadow">
                     <img class="img-fluid" src={{ asset("/img/menu/icedspanishlatte.jpg")}} alt="" />
                     <figcaption>
                        <div class="port-icon mt-3">
                           <a class="icon-ho venobox"></i></a>
                        </div>
                        <div class="service-list-des">
                           <h4>SPANISH LATTE</h4>
                           <p>Lorem ipsum dolor sit amet consectetur ullamco adipiscing elit, sed do eiusmod tempor exercitat incididunt ut labore.</p>
                           <div class="price-order">
                           <h5>₱80</h5>
                           <button class="order-now-btn">ORDER NOW</button>
                           </div>
                       </div>
                     </figcaption>
                  </figure>
               </div>
               <!--  end single item -->
               <div class="col-lg-4 col-md-6 col-12 one">
                  <figure class="service-list-item shadow">
                     <img class="img-fluid" src={{ asset("/img/menu/iceddirtymatcha.jpg")}} alt="" />
                     <figcaption>
                        <div class="port-icon mt-3">
                           <a class="icon-ho venobox"></i></a>
                        </div>
                        <div class="service-list-des">
                           <h4>DIRTY MATCHA</h4>
                           <p>Lorem ipsum dolor sit amet consectetur ullamco adipiscing elit, sed do eiusmod tempor exercitat incididunt ut labore.</p>
                           <div class="price-order">
                           <h5>₱80</h5>
                           <button class="order-now-btn">ORDER NOW</button>
                           </div>
                       </div>
                     </figcaption>
                  </figure>
               </div>
               <!--  end single item -->
               <div class="col-lg-4 col-md-6 col-12 one">
                  <figure class="service-list-item shadow">
                     <img class="img-fluid" src={{ asset("/img/menu/icedcaramelm.jpg")}} alt="" />
                     <figcaption>
                        <div class="port-icon mt-3">
                           <a class="icon-ho venobox"></i></a>
                        </div>
                        <div class="service-list-des">
                           <h4>CARAMEL MACCHIATO</h4>
                           <p>Lorem ipsum dolor sit amet consectetur ullamco adipiscing elit, sed do eiusmod tempor exercitat incididunt ut labore.</p>
                           <div class="price-order">
                           <h5>₱80</h5>
                           <button class="order-now-btn">ORDER NOW</button>
                           </div>
                       </div>
                     </figcaption>
                  </figure>
               </div>
               <!--  end single item -->
               <div class="col-lg-4 col-md-6 col-12 two">
                  <figure class="service-list-item shadow">
                     <img class="img-fluid" src={{ asset("/img/menu/darckchoco.jpg")}} alt="" />
                     <figcaption>
                        <div class="port-icon mt-3">
                           <a class="icon-ho venobox"></i></a>
                        </div>
                        <div class="service-list-des">
                           <h4>DARK CHOCOLATE LATTE</h4>
                           <p>Lorem ipsum dolor sit amet consectetur ullamco adipiscing elit, sed do eiusmod tempor exercitat incididunt ut labore.</p>
                           <div class="price-order">
                           <h5>₱80</h5>
                           <button class="order-now-btn">ORDER NOW</button>
                           </div>
                       </div>
                     </figcaption>
                  </figure>
               </div>
               <!--  end single item -->
               <div class="col-lg-4 col-md-6 col-12 two">
                  <figure class="service-list-item shadow">
                     <img class="img-fluid" src={{ asset("/img/menu/strawberrylatte.jpg")}} alt="" />
                     <figcaption>
                        <div class="port-icon mt-3">
                           <a class="icon-ho venobox"></i></a>
                        </div>
                        <div class="service-list-des">
                           <h4>STRAWBERRY LATTE</h4>
                           <p>Lorem ipsum dolor sit amet consectetur ullamco adipiscing elit, sed do eiusmod tempor exercitat incididunt ut labore.</p>
                           <div class="price-order">
                           <h5>₱80</h5>
                           <button class="order-now-btn">ORDER NOW</button>
                           </div>
                       </div>
                     </figcaption>
                  </figure>
               </div>
               <!--  end single item -->
               <div class="col-lg-4 col-md-6 col-12 two">
                  <figure class="service-list-item shadow">
                     <img class="img-fluid" src={{ asset("/img/menu/matchalatte.jpg")}} alt="" />
                     <figcaption>
                        <div class="port-icon mt-3">
                           <a class="icon-ho venobox"></i></a>
                        </div>
                        <div class="service-list-des">
                           <h4>MATCHA LATTE</h4>
                           <p>Lorem ipsum dolor sit amet consectetur ullamco adipiscing elit, sed do eiusmod tempor exercitat incididunt ut labore.</p>
                           <div class="price-order">
                           <h5>₱80</h5>
                           <button class="order-now-btn">ORDER NOW</button>
                           </div>
                       </div>
                     </figcaption>
                  </figure>
               </div>
               <!--  end single item -->

               <div class="col-lg-4 col-md-6 col-12 three">
                  <figure class="service-list-item shadow">
                     <img class="img-fluid" src={{ asset("/img/gallery/3.jpg")}} alt="" />
                     <figcaption>
                        <div class="port-icon mt-3">
                           <a class="icon-ho venobox"></i></a>
                        </div>
                        <div class="service-list-des">
                           <h4>MOGAMBO</h4>
                           <p>Lorem ipsum dolor sit amet consectetur ullamco adipiscing elit, sed do eiusmod tempor exercitat incididunt ut labore.</p>
                           <div class="price-order">
                           <h5>₱75</h5>
                           <button class="order-now-btn">ORDER NOW</button>
                           </div>
                       </div>
                     </figcaption>
                  </figure>
               </div>
               <!--  end single item -->

               <div class="col-lg-4 col-md-6 col-12 three">
                  <figure class="service-list-item shadow">
                     <img class="img-fluid" src={{ asset("/img/gallery/3.jpg")}} alt="" />
                     <figcaption>
                        <div class="port-icon mt-3">
                           <a class="icon-ho venobox"></i></a>
                        </div>
                        <div class="service-list-des">
                           <h4>OSMANTHUS SENCHA</h4>
                           <p>Lorem ipsum dolor sit amet consectetur ullamco adipiscing elit, sed do eiusmod tempor exercitat incididunt ut labore.</p>
                           <div class="price-order">
                           <h5>₱75</h5>
                           <button class="order-now-btn">ORDER NOW</button>
                           </div>
                       </div>
                     </figcaption>
                  </figure>
               </div>
               <!--  end single item -->

               <div class="col-lg-4 col-md-6 col-12 three">
                  <figure class="service-list-item shadow">
                     <img class="img-fluid" src={{ asset("/img/gallery/3.jpg")}} alt="" />
                     <figcaption>
                        <div class="port-icon mt-3">
                           <a class="icon-ho venobox"></i></a>
                        </div>
                        <div class="service-list-des">
                           <h4>AZTECA D'ORO</h4>
                           <p>Lorem ipsum dolor sit amet consectetur ullamco adipiscing elit, sed do eiusmod tempor exercitat incididunt ut labore.</p>
                           <div class="price-order">
                           <h5>₱80</h5>
                           <button class="order-now-btn">ORDER NOW</button>
                           </div>
                       </div>
                     </figcaption>
                  </figure>
               </div>
               <!--  end single item -->

               <div class="col-lg-4 col-md-6 col-12 three">
                  <figure class="service-list-item shadow">
                     <img class="img-fluid" src={{ asset("/img/gallery/3.jpg")}} alt="" />
                     <figcaption>
                        <div class="port-icon mt-3">
                           <a class="icon-ho venobox"></i></a>
                        </div>
                        <div class="service-list-des">
                           <h4>TOMATINO</h4>
                           <p>Lorem ipsum dolor sit amet consectetur ullamco adipiscing elit, sed do eiusmod tempor exercitat incididunt ut labore.</p>
                           <div class="price-order">
                           <h5>₱85</h5>
                           <button class="order-now-btn">ORDER NOW</button>
                           </div>
                       </div>
                     </figcaption>
                  </figure>
               </div>
               <!--  end single item -->

               <div class="col-lg-4 col-md-6 col-12 three">
                  <figure class="service-list-item shadow">
                     <img class="img-fluid" src={{ asset("/img/gallery/3.jpg")}} alt="" />
                     <figcaption>
                        <div class="port-icon mt-3">
                           <a class="icon-ho venobox"></i></a>
                        </div>
                        <div class="service-list-des">
                           <h4>BRITISH BREAKFAST</h4>
                           <p>Lorem ipsum dolor sit amet consectetur ullamco adipiscing elit, sed do eiusmod tempor exercitat incididunt ut labore.</p>
                           <div class="price-order">
                           <h5>₱85</h5>
                           <button class="order-now-btn">ORDER NOW</button>
                           </div>
                       </div>
                     </figcaption>
                  </figure>
               </div>
               <!--  end single item -->

               <div class="col-lg-4 col-md-6 col-12 three">
                  <figure class="service-list-item shadow">
                     <img class="img-fluid" src={{ asset("/img/menu/chocomt.jpg")}} alt="" />
                     <figcaption>
                        <div class="port-icon mt-3">
                           <a class="icon-ho venobox"></i></a>
                        </div>
                        <div class="service-list-des">
                           <h4>CHOCOLATE MILK TEA</h4>
                           <p>Lorem ipsum dolor sit amet consectetur ullamco adipiscing elit, sed do eiusmod tempor exercitat incididunt ut labore.</p>
                           <div class="price-order">
                           <h5>₱59</h5>
                           <button class="order-now-btn">ORDER NOW</button>
                           </div>
                       </div>
                     </figcaption>
                  </figure>
               </div>
               <!--  end single item -->

               <div class="col-lg-4 col-md-6 col-12 three">
                  <figure class="service-list-item shadow">
                     <img class="img-fluid" src={{ asset("/img/menu/wintermelonmt.jpg")}} alt="" />
                     <figcaption>
                        <div class="port-icon mt-3">
                           <a class="icon-ho venobox"></i></a>
                        </div>
                        <div class="service-list-des">
                           <h4>WINTERMELON MILK TEA</h4>
                           <p>Lorem ipsum dolor sit amet consectetur ullamco adipiscing elit, sed do eiusmod tempor exercitat incididunt ut labore.</p>
                           <div class="price-order">
                           <h5>₱59</h5>
                           <button class="order-now-btn">ORDER NOW</button>
                           </div>
                       </div>
                     </figcaption>
                  </figure>
               </div>
               <!--  end single item -->

               <div class="col-lg-4 col-md-6 col-12 three">
                  <figure class="service-list-item shadow">
                     <img class="img-fluid" src={{ asset("/img/menu/matchamt.jpg")}} alt="" />
                     <figcaption>
                        <div class="port-icon mt-3">
                           <a class="icon-ho venobox"></i></a>
                        </div>
                        <div class="service-list-des">
                           <h4>MATCHA MILK TEA</h4>
                           <p>Lorem ipsum dolor sit amet consectetur ullamco adipiscing elit, sed do eiusmod tempor exercitat incididunt ut labore.</p>
                           <div class="price-order">
                           <h5>₱59</h5>
                           <button class="order-now-btn">ORDER NOW</button>
                           </div>
                       </div>
                     </figcaption>
                  </figure>
               </div>
               <!--  end single item -->

               <div class="col-lg-4 col-md-6 col-12 four">
                  <figure class="service-list-item shadow">
                     <img class="img-fluid" src={{ asset("/img/menu/greenapple.jpg")}} alt="" />
                     <figcaption>
                        <div class="port-icon mt-3">
                           <a class="icon-ho venobox"></i></a>
                        </div>
                        <div class="service-list-des">
                           <h4>GREEN APPLE</h4>
                           <p>Lorem ipsum dolor sit amet consectetur ullamco adipiscing elit, sed do eiusmod tempor exercitat incididunt ut labore.</p>
                           <div class="price-order">
                           <h5>₱89</h5>
                           <button class="order-now-btn">ORDER NOW</button>
                           </div>
                       </div>
                     </figcaption>
                  </figure>
               </div>
               <!--  end single item -->

               <div class="col-lg-4 col-md-6 col-12 four">
                  <figure class="service-list-item shadow">
                     <img class="img-fluid" src={{ asset("/img/menu/raspberry.jpg")}} alt="" />
                     <figcaption>
                        <div class="port-icon mt-3">
                           <a class="icon-ho venobox"></i></a>
                        </div>
                        <div class="service-list-des">
                           <h4>RASPBERRY-SOUR CANDY</h4>
                           <p>Lorem ipsum dolor sit amet consectetur ullamco adipiscing elit, sed do eiusmod tempor exercitat incididunt ut labore.</p>
                           <div class="price-order">
                           <h5>₱109</h5>
                           <button class="order-now-btn">ORDER NOW</button>
                           </div>
                       </div>
                     </figcaption>
                  </figure>
               </div>
               <!--  end single item -->

               <div class="col-lg-4 col-md-6 col-12 four">
                  <figure class="service-list-item shadow">
                     <img class="img-fluid" src={{ asset("/img/menu/mixedberries.jpg")}} alt="" />
                     <figcaption>
                        <div class="port-icon mt-3">
                           <a class="icon-ho venobox"></i></a>
                        </div>
                        <div class="service-list-des">
                           <h4>MIXED BERRIES</h4>
                           <p>Lorem ipsum dolor sit amet consectetur ullamco adipiscing elit, sed do eiusmod tempor exercitat incididunt ut labore.</p>
                           <div class="price-order">
                           <h5>₱109</h5>
                           <button class="order-now-btn">ORDER NOW</button>
                           </div>
                       </div>
                     </figcaption>
                  </figure>
               </div>
               <!--  end single item -->

               <div class="col-lg-4 col-md-6 col-12 five">
                  <figure class="service-list-item shadow">
                     <img class="img-fluid" src={{ asset("/img/gallery/3.jpg")}} alt="" />
                     <figcaption>
                        <div class="port-icon mt-3">
                           <a class="icon-ho venobox"></i></a>
                        </div>
                        <div class="service-list-des">
                           <h4>BANANA CREAM WITH CHEESE</h4>
                           <p>Lorem ipsum dolor sit amet consectetur ullamco adipiscing elit, sed do eiusmod tempor exercitat incididunt ut labore.</p>
                           <div class="price-order">
                           <h5>₱69</h5>
                           <button class="order-now-btn">ORDER NOW</button>
                           </div>
                       </div>
                     </figcaption>
                  </figure>
               </div>
               <!--  end single item -->

               <div class="col-lg-4 col-md-6 col-12 five">
                  <figure class="service-list-item shadow">
                     <img class="img-fluid" src={{ asset("/img/menu/chocolatecoffeepudding.jpg")}} alt="chocolate-coffee pudding" />
                     <figcaption>
                        <div class="port-icon mt-3">
                           <a class="icon-ho venobox"></i></a>
                        </div>
                        <div class="service-list-des">
                           <h4>CHOCOLATE-COFFEE PUDDING</h4>
                           <p>Lorem ipsum dolor sit amet consectetur ullamco adipiscing elit, sed do eiusmod tempor exercitat incididunt ut labore.</p>
                           <div class="price-order">
                           <h5>₱69</h5>
                           <button class="order-now-btn">ORDER NOW</button>
                           </div>
                       </div>
                     </figcaption>
                  </figure>
               </div>
               <!--  end single item -->

               <div class="col-lg-4 col-md-6 col-12 five">
                  <figure class="service-list-item shadow">
                     <img class="img-fluid" src={{ asset("/img/menu/chocolatewaffle.jpg")}} alt="chocolate waffle" />
                     <figcaption>
                        <div class="port-icon mt-3">
                           <a class="icon-ho venobox"></i></a>
                        </div>
                        <div class="service-list-des">
                           <h4>HERSHEY'S CHOCOLATE WAFFLE</h4>
                           <p>Lorem ipsum dolor sit amet consectetur ullamco adipiscing elit, sed do eiusmod tempor exercitat incididunt ut labore.</p>
                           <div class="price-order">
                           <h5>₱79</h5>
                           <button class="order-now-btn">ORDER NOW</button>
                           </div>
                       </div>
                     </figcaption>
                  </figure>
               </div>
               <!--  end single item -->

               <div class="col-lg-4 col-md-6 col-12 five">
                  <figure class="service-list-item shadow">
                     <img class="img-fluid" src={{ asset("/img/menu/strawberrywaffle.jpg")}} alt="strawberry waffle" />
                     <figcaption>
                        <div class="port-icon mt-3">
                           <a class="icon-ho venobox"></i></a>
                        </div>
                        <div class="service-list-des">
                           <h4>HERSHEY'S STRAWBERRY WAFFLE</h4>
                           <p>Lorem ipsum dolor sit amet consectetur ullamco adipiscing elit, sed do eiusmod tempor exercitat incididunt ut labore.</p>
                           <div class="price-order">
                           <h5>₱79</h5>
                           <button class="order-now-btn">ORDER NOW</button>
                           </div>
                       </div>
                     </figcaption>
                  </figure>
               </div>
               <!--  end single item -->

               <div class="col-lg-4 col-md-6 col-12 five">
                  <figure class="service-list-item shadow">
                     <img class="img-fluid" src={{ asset("/img/menu/caramelwaffle.jpg")}} alt="caramel waffle" />
                     <figcaption>
                        <div class="port-icon mt-3">
                           <a class="icon-ho venobox"></i></a>
                        </div>
                        <div class="service-list-des">
                           <h4>HERSHEY'S CARAMEL WAFFLE</h4>
                           <p>Lorem ipsum dolor sit amet consectetur ullamco adipiscing elit, sed do eiusmod tempor exercitat incididunt ut labore.</p>
                           <div class="price-order">
                           <h5>₱79</h5>
                           <button class="order-now-btn">ORDER NOW</button>
                           </div>
                       </div>
                     </figcaption>
                  </figure>
               </div>
               <!--  end single item -->

               <div class="col-lg-4 col-md-6 col-12 five">
                  <figure class="service-list-item shadow">
                     <img class="img-fluid" src={{ asset("/img/menu/garlicbread.jpg")}} alt="toasted garlic bread" />
                     <figcaption>
                        <div class="port-icon mt-3">
                           <a class="icon-ho venobox"></i></a>
                        </div>
                        <div class="service-list-des">
                           <h4>TOASTED GARLIC BREAD</h4>
                           <p>Lorem ipsum dolor sit amet consectetur ullamco adipiscing elit, sed do eiusmod tempor exercitat incididunt ut labore.</p>
                           <div class="price-order">
                           <h5>₱100</h5>
                           <button class="order-now-btn">ORDER NOW</button>
                           </div>
                       </div>
                     </figcaption>
                  </figure>
               </div>
               <!--  end single item -->

               <div class="col-lg-4 col-md-6 col-12 five">
                  <figure class="service-list-item shadow">
                     <img class="img-fluid" src={{ asset("/img/menu/nachos.jpg")}} alt="beef nachos" />
                     <figcaption>
                        <div class="port-icon mt-3">
                           <a class="icon-ho venobox"></i></a>
                        </div>
                        <div class="service-list-des">
                           <h4>BEEF NACHOS</h4>
                           <p>Lorem ipsum dolor sit amet consectetur ullamco adipiscing elit, sed do eiusmod tempor exercitat incididunt ut labore.</p>
                           <div class="price-order">
                           <h5>₱169</h5>
                           <button class="order-now-btn">ORDER NOW</button>
                           </div>
                       </div>
                     </figcaption>
                  </figure>
               </div>
               <!--  end single item -->

               <div class="col-lg-4 col-md-6 col-12 five">
                  <figure class="service-list-item shadow">
                     <img class="img-fluid" src={{ asset("/img/menu/pizza.jpg")}} alt="pizza" />
                     <figcaption>
                        <div class="port-icon mt-3">
                           <a class="icon-ho venobox"></i></a>
                        </div>
                        <div class="service-list-des">
                           <h4>WHITE SAUCE HAWAIIAN PIZZA</h4>
                           <p>Lorem ipsum dolor sit amet consectetur ullamco adipiscing elit, sed do eiusmod tempor exercitat incididunt ut labore.</p>
                           <div class="price-order">
                           <h5>₱198</h5>
                           <button class="order-now-btn">ORDER NOW</button>
                           </div>
                       </div>
                     </figcaption>
                  </figure>
               </div>
               <!--  end single item -->

               <div class="col-lg-4 col-md-6 col-12 five">
                  <figure class="service-list-item shadow">
                     <img class="img-fluid" src={{ asset("/img/menu/clubhouse.jpg")}} alt="clubhouse sandwich" />
                     <figcaption>
                        <div class="port-icon mt-3">
                           <a class="icon-ho venobox"></i></a>
                        </div>
                        <div class="service-list-des">
                           <h4>CLUBHOUSE SANDWICH</h4>
                           <p>Lorem ipsum dolor sit amet consectetur ullamco adipiscing elit, sed do eiusmod tempor exercitat incididunt ut labore.</p>
                           <div class="price-order">
                           <h5>₱189</h5>
                           <button class="order-now-btn">ORDER NOW</button>
                           </div>
                       </div>
                     </figcaption>
                  </figure>
               </div>
               <!--  end single item -->

               <div class="col-lg-4 col-md-6 col-12 five">
                  <figure class="service-list-item shadow">
                     <img class="img-fluid" src={{ asset("/img/menu/ramen.jpg")}} alt="ku-ramen" />
                     <figcaption>
                        <div class="port-icon mt-3">
                           <a class="icon-ho venobox"></i></a>
                        </div>
                        <div class="service-list-des">
                           <h4>KU-RAMEN</h4>
                           <p>Lorem ipsum dolor sit amet consectetur ullamco adipiscing elit, sed do eiusmod tempor exercitat incididunt ut labore.</p>
                           <div class="price-order">
                           <h5>₱149</h5>
                           <button class="order-now-btn">ORDER NOW</button>
                           </div>
                       </div>
                     </figcaption>
                  </figure>
               </div>
               <!--  end single item -->

      </section>
      <!-- END PORTFOLIO PAGE SECTION -->



      <!-- START OF MODAL STRUCTURE -->
      <div id="orderModal" class="modal">
         <div class="modal-content">
            <span class="close-btn">&times;</span>
           
            <!-- Size Options -->
            <div class="option-group">
               <h3>HOT</h3>
               <div class="options">
                  <button class="option-btn">Regular</button>
                  <button class="option-btn">Large</button>
               </div>
            </div>

            <!-- Extra Options -->
            <div class="option-group">
               <h3>ICED</h3>
               <div class="options">
                  <button class="option-btn">Regular</button>
                  <button class="option-btn">Large</button>
               </div>
            </div>
            
            <!-- Price and Quantity -->
            <div class="price-quantity">
               <h4>₱99</h4>
               <div class="quantity-control">
                  <button class="quantity-btn">−</button>
                  <input type="text" value="1" class="quantity-input">
                  <button class="quantity-btn">+</button>
               </div>
            </div>

            <!-- Place Order Button -->
            <button class="place-order-btn">Place Order</button>
         </div>
      </div>

      <!-- END OF MODAL STRUCTURE -->


      <!-- START CALL TO ACTION SECTION -->
      <section id="calltoactiontwo" class="callto-action-padding bg-theme">
         <div class="auto-container">
            <div class="row">
               <div class="col-lg-9 col-md-6 col-12 mb-lg-0 mb-4">
                  <div class="callto-action-left">
                     <h2></h2>
                     <p>NORTHERN MINDANAO FOOD INNOVATION CENTER IMAGE GALLERY</p>
                  </div>
               </div>
         </div>
      </section>
      <!-- START CALL TO ACTION SECTION -->

           <!-- START FOOTER -->
           <footer class="footer-section">
            <div id="top-footer" class="overlay-2 section-back-image-2" data-background="assets/img/bg/fic-footer.jpg">
               <div class="auto-container">
                  <div class="row">
                     <div class="col-lg-3 col-md-6 col-sm-12 col-12 mb-lg-0 mb-md-5 mb-sm-5 mb-5">
                        <div class="footer-widget-title col-12 p-0">
                           <div class="logo">
                              <a href="index.html">
                                 <img class="img-fluid" src={{ asset("/img/ff.jpg")}} alt="">
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
                              <img src={{ asset("/img/NMFIC2.jpg")}} alt="" class="img-fluid">
                              <h6 class="recTitle">
                                 <a href="#">USTP CDO COVID-19 Initiative</a>
                              </h6>
                              <p class="posted-on">1 APRIL 2020</p>
                           </div>
                           <div class="singleRecpost">
                              <img src={{ asset("/img/NMFIC2.jpg")}} alt="" class="img-fluid">
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
                              <li><a href="documents.html"><i class="icofont-circled-right"></i> Documents</a></li>
                              <li><a href="services.html"><i class="icofont-circled-right"></i> Latest Services</a></li>
                              <li><a href="admin.html"><i class="icofont-circled-right"></i> Administration</a></li>
                              <li><a href="gallery.html"><i class="icofont-circled-right"></i> Image Gallery</a></li>
                              <li><a href="faq.html"><i class="icofont-circled-right"></i> FAQs</a></li>
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
                              <li><a href="index.html">Home</a></li>
                              <li><a href="about.html">About Us</a></li>
                              <li><a href="contact.html">Contact Us</a></li>
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
      <script src="{{ asset('js/ordermodal.js') }}"></script>
   </body>
   </html>
@endsection
