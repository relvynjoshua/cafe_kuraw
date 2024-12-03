@extends('layouts.app')

@section('title', 'Menu')

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
   <title>KURAW - Menu</title>

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
         </div> <!-- end portfolio menu list -->
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
                           <p>Lorem ipsum dolor sit amet consectetur ullamco adipiscing elit, sed do eiusmod tempor
                              exercitat incididunt ut labore.</p>
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
                           <p>Lorem ipsum dolor sit amet consectetur ullamco adipiscing elit, sed do eiusmod tempor
                              exercitat incididunt ut labore.</p>
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
                           <p>Lorem ipsum dolor sit amet consectetur ullamco adipiscing elit, sed do eiusmod tempor
                              exercitat incididunt ut labore.</p>
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
                           <p>Lorem ipsum dolor sit amet consectetur ullamco adipiscing elit, sed do eiusmod tempor
                              exercitat incididunt ut labore.</p>
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
                           <p>Lorem ipsum dolor sit amet consectetur ullamco adipiscing elit, sed do eiusmod tempor
                              exercitat incididunt ut labore.</p>
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
                           <p>Lorem ipsum dolor sit amet consectetur ullamco adipiscing elit, sed do eiusmod tempor
                              exercitat incididunt ut labore.</p>
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
                           <p>Lorem ipsum dolor sit amet consectetur ullamco adipiscing elit, sed do eiusmod tempor
                              exercitat incididunt ut labore.</p>
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
                           <p>Lorem ipsum dolor sit amet consectetur ullamco adipiscing elit, sed do eiusmod tempor
                              exercitat incididunt ut labore.</p>
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
                           <p>Lorem ipsum dolor sit amet consectetur ullamco adipiscing elit, sed do eiusmod tempor
                              exercitat incididunt ut labore.</p>
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
                           <p>Lorem ipsum dolor sit amet consectetur ullamco adipiscing elit, sed do eiusmod tempor
                              exercitat incididunt ut labore.</p>
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
                           <p>Lorem ipsum dolor sit amet consectetur ullamco adipiscing elit, sed do eiusmod tempor
                              exercitat incididunt ut labore.</p>
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
                           <p>Lorem ipsum dolor sit amet consectetur ullamco adipiscing elit, sed do eiusmod tempor
                              exercitat incididunt ut labore.</p>
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
                           <p>Lorem ipsum dolor sit amet consectetur ullamco adipiscing elit, sed do eiusmod tempor
                              exercitat incididunt ut labore.</p>
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
                           <p>Lorem ipsum dolor sit amet consectetur ullamco adipiscing elit, sed do eiusmod tempor
                              exercitat incididunt ut labore.</p>
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
                           <p>Lorem ipsum dolor sit amet consectetur ullamco adipiscing elit, sed do eiusmod tempor
                              exercitat incididunt ut labore.</p>
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
                           <p>Lorem ipsum dolor sit amet consectetur ullamco adipiscing elit, sed do eiusmod tempor
                              exercitat incididunt ut labore.</p>
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
                           <p>Lorem ipsum dolor sit amet consectetur ullamco adipiscing elit, sed do eiusmod tempor
                              exercitat incididunt ut labore.</p>
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
                           <p>Lorem ipsum dolor sit amet consectetur ullamco adipiscing elit, sed do eiusmod tempor
                              exercitat incididunt ut labore.</p>
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
                           <p>Lorem ipsum dolor sit amet consectetur ullamco adipiscing elit, sed do eiusmod tempor
                              exercitat incididunt ut labore.</p>
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
                           <p>Lorem ipsum dolor sit amet consectetur ullamco adipiscing elit, sed do eiusmod tempor
                              exercitat incididunt ut labore.</p>
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
                           <p>Lorem ipsum dolor sit amet consectetur ullamco adipiscing elit, sed do eiusmod tempor
                              exercitat incididunt ut labore.</p>
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
                           <p>Lorem ipsum dolor sit amet consectetur ullamco adipiscing elit, sed do eiusmod tempor
                              exercitat incididunt ut labore.</p>
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
                           <p>Lorem ipsum dolor sit amet consectetur ullamco adipiscing elit, sed do eiusmod tempor
                              exercitat incididunt ut labore.</p>
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
                           <p>Lorem ipsum dolor sit amet consectetur ullamco adipiscing elit, sed do eiusmod tempor
                              exercitat incididunt ut labore.</p>
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
                     <img class="img-fluid" src={{ asset("/img/menu/chocolatecoffeepudding.jpg")}}
                        alt="chocolate-coffee pudding" />
                     <figcaption>
                        <div class="port-icon mt-3">
                           <a class="icon-ho venobox"></i></a>
                        </div>
                        <div class="service-list-des">
                           <h4>CHOCOLATE-COFFEE PUDDING</h4>
                           <p>Lorem ipsum dolor sit amet consectetur ullamco adipiscing elit, sed do eiusmod tempor
                              exercitat incididunt ut labore.</p>
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
                           <p>Lorem ipsum dolor sit amet consectetur ullamco adipiscing elit, sed do eiusmod tempor
                              exercitat incididunt ut labore.</p>
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
                           <p>Lorem ipsum dolor sit amet consectetur ullamco adipiscing elit, sed do eiusmod tempor
                              exercitat incididunt ut labore.</p>
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
                           <p>Lorem ipsum dolor sit amet consectetur ullamco adipiscing elit, sed do eiusmod tempor
                              exercitat incididunt ut labore.</p>
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
                           <p>Lorem ipsum dolor sit amet consectetur ullamco adipiscing elit, sed do eiusmod tempor
                              exercitat incididunt ut labore.</p>
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
                           <p>Lorem ipsum dolor sit amet consectetur ullamco adipiscing elit, sed do eiusmod tempor
                              exercitat incididunt ut labore.</p>
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
                           <p>Lorem ipsum dolor sit amet consectetur ullamco adipiscing elit, sed do eiusmod tempor
                              exercitat incididunt ut labore.</p>
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
                           <p>Lorem ipsum dolor sit amet consectetur ullamco adipiscing elit, sed do eiusmod tempor
                              exercitat incididunt ut labore.</p>
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
                           <p>Lorem ipsum dolor sit amet consectetur ullamco adipiscing elit, sed do eiusmod tempor
                              exercitat incididunt ut labore.</p>
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