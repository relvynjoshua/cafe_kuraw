@extends('layouts.app')

@section('title', 'Contact')

@section('content')

<!-- Latest jQuery -->

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
   <title>Kuraw - Contact</title>

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

<!-- Contact Page Section -->
<section id="contact" class="section-padding">
   <div class="auto-container">
      <div class="row">
         <!-- Address Section -->
         <div class="col-lg-5 col-md-5 col-12 mb-5">
            <div class="address-box-wrap bg-gray shadow-sm p-4">
               <div class="address-box-sin mb-4">
                  <div class="address-box-icon">
                     <i class="fas fa-map-marker-alt"></i> <!-- Font Awesome alternative -->
                  </div>
                  <div class="address-box-des">
                     <h4>Coffee Shop Address</h4>
                     <p>San Pedro St, Capisnon, Kauswagan, Cagayan de Oro, <br> 9000 Misamis Oriental</p>
                  </div>
               </div>
               <div class="address-box-sin mb-4">
                  <div class="address-box-icon">
                     <i class="fas fa-envelope"></i> <!-- Font Awesome alternative -->
                  </div>
                  <div class="address-box-des">
                     <h4>Email Us</h4>
                     <p>kuraw@gmail.com</p>
                  </div>
               </div>
               <div class="address-box-sin mb-4">
                  <div class="address-box-icon">
                     <i class="fas fa-phone-alt"></i> <!-- Font Awesome alternative -->
                  </div>
                  <div class="address-box-des">
                     <h4>Phone</h4>
                     <p>0956 165 7495</p>
                  </div>
               </div>
               <div class="address-box-sin">
                  <div class="address-box-icon">
                     <i class="fas fa-clock"></i> <!-- Font Awesome alternative -->
                  </div>
                  <div class="address-box-des">
                     <h4>Opening Time</h4>
                     <p>Mon - Sun: 11 AM - 9 PM</p>
                  </div>
               </div>
            </div>
         </div>


         <!-- Contact Form Section -->
         <div class="col-lg-7 col-md-7 col-12">
            <div class="contact-heading mb-4">
               <h2>Inquire</h2>
            </div>
            <!-- Flash Messages -->
            @if (session('success'))
            <div class="alert alert-success">
               {{ session('success') }}
            </div>
         @elseif (session('error'))
         <div class="alert alert-danger">
            {{ session('error') }}
         </div>
      @endif
            <!-- Contact Form -->
            <div class="contact-form-wrap">
               <form id="contact-form" method="POST" action="{{ route('contact.process') }}">
                  @csrf
                  <div class="row">
                     <div class="col-md-6">
                        <div class="form-group">
                           <label for="name">Name*</label>
                           <input type="text" class="form-control" name="name" placeholder="Enter your Name"
                              value="{{ old('name') }}" required>
                        </div>
                     </div>
                     <div class="col-md-6">
                        <div class="form-group">
                           <label for="email">Email*</label>
                           <input type="email" class="form-control" name="email" placeholder="Enter your Email"
                              value="{{ old('email') }}" required>
                        </div>
                     </div>
                  </div>
                  <div class="row">
                     <div class="col-md-6">
                        <div class="form-group">
                           <label for="phone">Contact Number*</label>
                           <input type="text" class="form-control" name="phone" placeholder="xxx-xxx-xxxx"
                              value="{{ old('phone') }}" required>
                        </div>
                     </div>
                     <div class="col-md-6">
                        <div class="form-group">
                           <label for="subject">Subject*</label>
                           <input type="text" class="form-control" name="subject" placeholder="Subject"
                              value="{{ old('subject') }}" required>
                        </div>
                     </div>
                  </div>
                  <div class="form-group">
                     <label for="message">Message*</label>
                     <textarea class="form-control" name="message" rows="6" placeholder="Message"
                        required>{{ old('message') }}</textarea>
                  </div>
                  <div class="text-center">
                     <button type="submit" class="btn btn-primary">Submit Message</button>
                  </div>
               </form>
            </div>
         </div>
      </div>
   </div>

   <!-- Google Maps Section -->
   <section id="map-section">
      <div class="gmap_canvas">
         <iframe id="gmap_canvas"
            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d31567.597643495774!2d124.60938607740727!3d8.504264581170743!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x32fff3001ad9cef7%3A0x6040ed6825305ec8!2sK%C3%BAraw%20Coffee%20Shop!5e0!3m2!1sen!2sph!4v1731251173585!5m2!1sen!2sph"
            width="100%" height="400" style="border:0;" allowfullscreen="" loading="lazy"
            referrerpolicy="no-referrer-when-downgrade">
         </iframe>
      </div>
   </section>
</section>



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
@endsection