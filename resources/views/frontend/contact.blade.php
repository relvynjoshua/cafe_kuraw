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

      <!-- START CONTACT PAGE SECTION -->
      <section id="contcat" class="section-padding">
         <div class="auto-container">
            <div class="row">
               <div class="col-lg-5 col-md-5 col-12 mb-lg-0 mb-md-0 mb-5">
                 <div class="address-box-wrap bg-gray shadow-sm p-lg-5 p-md-3 p-3">
                     <div class="address-box-sin mb-4">
                        <div class="address-box-icon">
                           <i class="icofont-location-pin"></i>
                        </div>
                        <div class="address-box-des">
                           <h4>Coffee Shop Address</h4>
                           <p>San Pedro St, Capisnon, Kauswagan , Cagayan de Oro,  <br> 9000 Misamis Oriental</p>
                        </div>
                     </div>
                     <!-- end single address box -->
                     <div class="address-box-sin mb-4">
                        <div class="address-box-icon">
                           <i class="icofont-envelope-open"></i>
                        </div>
                        <div class="address-box-des">
                           <h4>Send Email</h4>
                           <p>kuraw@gmail.com <br> kuraw-coffee-shop.com</p>
                        </div>
                     </div>
                     <!-- end single address box -->
                     <div class="address-box-sin mb-4">
                        <div class="address-box-icon">
                           <i class="icofont-fax"></i>
                        </div>
                        <div class="address-box-des">
                           <h4>Phone</h4>
                           <p>0956 165 7495 </p>
                        </div>
                     </div>
                     <!-- end single address box -->
                     <div class="address-box-sin">
                        <div class="address-box-icon">
                           <i class="icofont-eye"></i>
                        </div>
                        <div class="address-box-des">
                           <h4>Opening Time</h4>
                           <p>Mon - Sun: 11 AM - 9 PM 
                        </div>
                     </div>
                     <!-- end single address box -->
                 </div>
               </div>
               <!-- end col -->
               <div class="col-lg-7 col-md-7 col-12 pl-lg-5 pl-md-3 pl-0">
                  <div class="contact-heading mb-5">
                     <h2>Inquire</h2>
                  </div>
                  <div class="contact-form-wrap">
                     <form id="main-form" class="contact-form form" name="enq" method="POST" action="form-process.php">
                        <div class="row">
                           <div class="col-md-6">
                              <div class="form-group">
                                 <span class="form-icon"><i class="icofont-user"></i></span>
                                 <input type="text" class="form-control" id="name" placeholder="Enter your Name" required>
                                 <label for="name">First Name*</label>
                              </div>
                           </div>
                           <div class="col-md-6">
                              <div class="form-group">
                                 <span class="form-icon"><i class="icofont-envelope"></i></span>
                                 <input type="email" class="form-control" id="email" placeholder="Enter your Email" required>
                                 <label for="email">Email*</label>
                              </div>
                           </div>
                        </div>
                        <div class="row">
                           <div class="col-md-6">
                              <div class="form-group">
                                 <span class="form-icon"><i class="icofont-ui-dial-phone"></i></span>
                                 <input type="text" class="form-control" id="number" placeholder="xxx-xxx-xxxx" required>
                                 <label for="number">Contact Number*</label>
                              </div>
                           </div>
                           <div class="col-md-6">
                              <div class="form-group">
                                 <span class="form-icon"><i class="icofont-at"></i></span>
                                 <input type="text" class="form-control" id="subject" placeholder="Subject" required>
                                 <label for="subject">Subject*</label>
                              </div>
                           </div>
                        </div>
                        <div class="form-group form-message">
                           <textarea class="form-control" id="message" rows="6" placeholder="Message"></textarea>
                           <label for="message">Message</label>
                        </div>
                        <div class="text-center wow fadeInUp">
                            <div class="actions">
                                <input value="SUBMIT MESSAGE" name="submit" id="submitButton" class="btn con-btn" title="Click here to submit your message!" type="submit">
                                <img src="assets/img/ajax-loader.gif" id="loader" style="display:none" alt="loading" width="16" height="16">
                            </div>
                        </div>
                     </form>
                  </div>
               </div>
               <!-- end col -->
            </div>
         </div>
      </section>
      <!-- END CONTACT PAGE SECTION -->

      <!-- START MAP SECTION -->
            <div class="gmap_canvas">
                <iframe 
                    id="gmap_canvas" 
                    src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d31567.597643495774!2d124.60938607740727!3d8.504264581170743!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x32fff3001ad9cef7%3A0x6040ed6825305ec8!2sK%C3%BAraw%20Coffee%20Shop!5e0!3m2!1sen!2sph!4v1731251173585!5m2!1sen!2sph" 
                    width="800" 
                    height="600" 
                    style="border:0;" 
                    allowfullscreen="" 
                    loading="lazy" 
                    referrerpolicy="no-referrer-when-downgrade">
                </iframe>
            </div>
      <!-- END MAP SECTION -->

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
@endsection