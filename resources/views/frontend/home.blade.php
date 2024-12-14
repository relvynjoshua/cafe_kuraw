@extends('layouts.app')

@section('title', 'Home Page')

@section('content')
<!DOCTYPE html>
<html lang="en">

<head>
    <!--Meta Tags-->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!--Favicons-->
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('assets/img/favicon.ico') }}" />

    <!--Page Title-->
    <title>KURAW - Home</title>

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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css">
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.min.css">
    <!-- Animate CSS -->
    <link rel="stylesheet" href="{{ asset('assets/css/animate.css') }}">
    <!-- Venobox -->
    <link rel="stylesheet" href="{{ asset('assets/venobox/css/venobox.min.css') }}" />
    <!-- Style CSS -->
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
    <!-- Responsive CSS -->
    <link rel="stylesheet" href="{{ asset('assets/css/responsive.css') }}">
</head>

<body id="main">
    <!-- START PRELOADER -->
    <div id="page-preloader">
        <div class="loader"></div>
        <div class="loa-shadow"></div>
    </div>
    <!-- END PRELOADER -->

    <!-- START SLIDER SECTION -->
    <section class="slider-section">
        <div class="home-slides owl-carousel owl-theme">
            <div class="home-single-slide" data-background="{{ asset('assets/img/kuraw/header.jpg') }}">
                <div class="home-single-slide-overlay"></div>
            </div>
            <div class="home-single-slide" data-background="{{ asset('assets/img/kuraw/day1.jpg') }}">
                <div class="home-single-slide-overlay"></div>
            </div>
            <div class="home-single-slide" data-background="{{ asset('assets/img/kuraw/nighters.jpg') }}">
                <div class="home-single-slide-overlay"></div>
            </div>
            <div class="home-single-slide" data-background="{{ asset('assets/img/kuraw/7.jpg') }}">
                <div class="home-single-slide-overlay"></div>
            </div>
        </div>
    </section>
    <!-- END SLIDER SECTION -->

    <!-- START WELCOME SECTION -->
    <section id="habout" class="welcome-section-padding">
        <div class="auto-container">
            <div class="row">
                <div class="col-lg-6 col-md-6 col-12 mb-lg-0 mb-lg-0 mb-5">
                    <div class="about-wel-des">
                        <h6 class="theme-color"><i class="fas fa-plus"></i> Kuraw Coffee Shop Info</h6>
                        <h2 class="my-4">ABOUT US</h2>
                        <p>Kuraw Coffee Shop, a micro, small, and medium-sized enterprise (MSME), was officially
                            established on March 8, 2024, as a sole proprietorship under the ownership of Sir Rolan
                            Lutrania.
                            Despite being registered as a sole proprietorship, the business is collaboratively managed
                            and operated in partnership with Sir William, reflecting a shared commitment to delivering
                            quality service and coffee experiences. We are located in a residential area in Capsinon,
                            Kauswagan, Cagayan de Oro City. The space and parking for customers are limited, but we
                            accept reservations for meetings.</p>
                        <p class="my-4"><b>Our menu features a delightful selectionof beverages and snacks,
                                catering to a wide range of tastes and preferences. We offer espresso-based coffee,
                                milk tea, hot tea, and fruit sodas for drinks, as well as nachos, sandwiches, and
                                waffles for snacks.</b></p>
                        <div class="about-btn wow fadeInUp">
                            <a href="#" class="about-us-into-btn-2 mr-2">Read More</a>
                            <a href="#" class="about-us-into-btn-icon"><i class="fas fa-caret-right"></i></a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 col-12">
                    <div class="about-wel-img-sec img-overlay">
                        <a class="venobox" data-autoplay="true" data-vbtype="video" data-title="Intro Video"
                            href="https://www.youtube.com/embed/Oq61TxejZ5g"><i class="fas fa-play"></i></a>
                        <div class="img-wrap">
                            <img class="img-fluid" src="{{ asset('assets/img/bg/home-about-img.jpg') }}" alt="">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- END WELCOME SECTION -->

    <!-- START SERVICES SECTION -->
    <section id="services" class="section-padding">
        <div class="auto-container">
            <div class="row">
                <div class="col-lg-7 col-md-7 col-12 mx-auto text-center">
                    <div class="section-title">
                        <h2>Achievements</h2>
                        <p>At Kuraw Coffee Shop, every cup showcases our dedication to quality and passion for coffee.
                            With certifications in barista expertise and food safety, we ensure top-notch service and
                            craftsmanship. From launching signature drinks to building lasting customer relationships,
                            our milestones celebrate meaningful connections. Using premium Italian coffee equipment, we
                            deliver consistent excellence, making us a cherished community favorite in Capsinon,
                            Kauswagan.</p>
                    </div>
                </div>
            </div>
            <!-- end section title -->
            <div class="row">
                <div class="col-lg-4 col-md-4 col-sm-12 col-12 text-center mb-lg-0 mb-md-0 mb-sm-4 mb-4">
                    <div class="single-service-item shadow bg-white">
                        <div class="icon-holder mb-3">
                            <div class="service-item-icon-bg">
                                <i class="fas fa-certificate"></i>
                            </div>
                        </div>
                        <div class="service-item-text-holder">
                            <h4>Certificates and Recognitions</h4>
                            <p>Kuraw Coffee Shop proudly upholds industry standards with certifications in barista
                                expertise and food safety.</p>
                            <a class="thm-btn" href="">READ MORE</a>
                        </div>
                    </div>
                </div>
                <!-- End single service item -->
                <div class="col-lg-4 col-md-4 col-sm-12 col-12 text-center mb-lg-0 mb-md-0 mb-sm-4 mb-4">
                    <div class="single-service-item shadow bg-white">
                        <div class="icon-holder mb-3">
                            <div class="service-item-icon-bg">
                                <i class="fas fa-trophy"></i>
                            </div>
                        </div>
                        <div class="service-item-text-holder">
                            <h4>Milestones</h4>
                            <p>From launching our signature drinks to celebrating years of meaningful relationships with
                                our customers, every milestone is a testament to our passion for coffee and connection.
                            </p>
                            <a class="thm-btn" href="">READ MORE</a>
                        </div>
                    </div>
                </div>
                <!-- End single service item -->
                <div class="col-lg-4 col-md-4 col-sm-12 col-12 text-center mb-lg-0 mb-md-0">
                    <div class="single-service-item shadow bg-white">
                        <div class="icon-holder mb-3">
                            <div class="service-item-icon-bg">
                                <i class="fas fa-coffee"></i>
                            </div>
                        </div>
                        <div class="service-item-text-holder">
                            <h4>Premium Equipment Investment</h4>
                            <p>Kuraw Coffee Shop takes pride in using high-quality Italian coffee equipment, ensuring
                                consistency and excellence in every cup.</p>
                            <a class="thm-btn" href="{{ route('gallery') }}">READ MORE</a>
                        </div>
                    </div>
                </div>
                <!-- End single service item -->
            </div>
        </div>
        <!--- END CONTAINER -->
    </section>
    <!-- END SERVICES SECTION -->

    <!-- START COUNTER SECTION -->
    <section id="counter" class="counter-padding overlay section-back-image"
        style="background-image: url('{{ asset('assets/img/kuraw/2kuraw.jpg') }}');">
        <div class="auto-container">
            <div class="row">
                <div class="col-lg-8 col-md-8 col-12 mx-lg-auto mx-md-auto mx-0">
                    <div class="counter-info">
                        <div class="counter-des">
                            <h2><span>The First & Only Coffee Shop in</span> <br>Capisnon, Kauswagan CDO!</h2>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row mt-5 wow fadeInUp">
                <div class="col-lg-8 col-md-8 col-12 mx-lg-auto mx-md-auto mx-0 text-lg-left text-md-left text-center">
                    <div class="row">
                        <div class="col-lg-3 col-md-3 col-sm-6 col-12 mb-lg-0 mb-md-0 mb-sm-4 mb-4">
                            <div class="single-counter-item">
                                <h4 class="timer">360</h4>
                                <p>Likes</p>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-3 col-sm-6 col-12 mb-lg-0 mb-md-0 mb-sm-4 mb-4">
                            <div class="single-counter-item">
                                <h4 class="timer">780</h4>
                                <p>Followers</p>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-3 col-sm-6 col-12 mb-lg-0 mb-md-0 mb-sm-0 mb-4">
                            <div class="single-counter-item">
                                <h4 class="timer">165</h4>
                                <p>Mentions</p>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-3 col-sm-6 col-12">
                            <div class="single-counter-item">
                                <h4 class="timer">95</h4>
                                <p>Satisfied Customers</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--- END CONTAINER -->
    </section>
    <!-- END COUNTER SECTION -->

    <!-- START TEAM SECTION -->
    <section id="team" class="section-padding">
        <div class="auto-container">
            <div class="row">
                <div class="col-lg-7 col-md-7 col-12 mx-auto text-center">
                    <div class="section-title">
                        <h2>Our Administration</h2>
                        <p>Kuraw Coffee Shop is proudly owned and operated as a sole proprietorship by Sir Rolan
                            Lutrania, with the dedicated partnership of Sir William Gaabucayan. Together, they bring a
                            shared vision and commitment to delivering exceptional coffee experiences and quality
                            service.</p>
                    </div>
                </div>
            </div>
            <div class="row mb-5">
                <div class="col">
                    <div class="team-slides owl-carousel owl-theme">
                        <div class="single-team-wrapper">
                            <div class="single-team-member">
                                <img class="img-fluid" src="{{ asset('assets/img/team/avatar.jpg') }}" alt="">
                                <div class="single-team-member-content">
                                    <div class="single-team-member-text">
                                        <h4>Rolan Lutrania</h4>
                                        <p>Owner</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="single-team-wrapper">
                            <div class="single-team-member">
                                <img class="img-fluid" src="{{ asset('assets/img/team/avatar.jpg') }}" alt="">
                                <div class="single-team-member-content">
                                    <div class="single-team-member-text">
                                        <h4>William Gaabucayan</h4>
                                        <p>Co-owner</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- END TEAM SECTION -->

    <!-- START TESTIMONIAL & FAQ SECTION -->
    <section id="testimonial" class="section-padding overlay section-back-image"
        style="background-image: url('{{ asset('assets/img/kuraw/5.jpg') }}');">
        <div class="auto-container">
            <div class="row ml-lg-4 ml-md-4 ml-0 mr-lg-4 mr-md-4 mr-0">
                <div class="col-lg-6 col-md-12 col-12 mb-lg-0 mb-md-5 mb-5">
                    <div class="section-title white-title section-title-left">
                        <h2>FEEDBACKS</h2>
                    </div>
                    <!-- end section title -->

                    <div class="owl-carousel owl-theme testimonial-wrapper">
                        <div class="item"
                            data-dot="<img class='testimonial-thumb rounded' src='{{ asset('assets/img/testimonial/p1.jpg') }}' />">
                            <div class="testimonial-inner">
                                <div class="tes-quote">
                                    <i class="fas fa-quote-left"></i>
                                </div>
                                <div class="tes-dec">
                                    <h4>Unbeatable Waffles and Matcha Bliss at Kuraw!</h4>
                                    <p class="author-des">Kuraw’s Waffle and Dirty Matcha Iced Coffee are the BEST!
                                        🫶🏻👌🏻
                                        Best iced coffee, Best coffee, Convenient location,
                                        Cosy atmosphere, and Relaxing atmosphere! </p>
                                    <p class="tes-author"><strong>Rosita</strong> - Satisfied Customer</p>
                                </div>
                            </div>
                        </div>
                        <!-- end single item -->
                        <div class="item"
                            data-dot="<img class='testimonial-thumb rounded' src='{{ asset('assets/img/testimonial/p2.jpg') }}' />">
                            <div class="testimonial-inner">
                                <div class="tes-quote">
                                    <i class="fas fa-quote-left"></i>
                                </div>
                                <div class="tes-dec">
                                    <h4>Convenient Location!</h4>
                                    <p class="author-des">I love their Dark Chocolate Latte, Creamy Matcha Latte,
                                        Chocolate Waffle, & Wintermelon Milk Tea! 💯</p>
                                    <p class="tes-author"><strong>Mikay</strong> - Satisfied Customer</p>
                                </div>
                            </div>
                        </div>
                        <!-- end single item -->
                        <div class="item"
                            data-dot="<img class='testimonial-thumb rounded' src='{{ asset('assets/img/testimonial/p3.jpg') }}' />">
                            <div class="testimonial-inner">
                                <div class="tes-quote">
                                    <i class="fas fa-quote-left"></i>
                                </div>
                                <div class="tes-dec">
                                    <h4>Cozy Vibes, Great Coffee, and Friendly Faces at Kuraw!</h4>
                                    <p class="author-des">KURAW offers a cozy ambiance to refreshing coffee, and warm
                                        hearted crew.☕️🧋 ♥️</p>
                                    <p class="tes-author"><strong>Marn</strong> - Satisfied Customer</p>
                                </div>
                            </div>
                        </div>
                        <!-- end single item -->
                    </div>
                </div>
                <!-- end col -->

                <div class="col-lg-6 col-md-12 col-12 mt-lg-0 mt-4">
                    <div class="section-title white-title section-title-left">
                        <h2>Frequently Asked Question</h2>
                    </div>
                    <!-- end section title -->
                    <div class="panel-group faq-home-accor" id="accordion">
                        <div class="panel panel-default mb-3">
                            <div class="panel-heading">
                                <h5 class="panel-title">
                                    <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion"
                                        href="#panel1">Where is the KURAW located? <i
                                            class="fas fa-minus text-white"></i></a>
                                </h5>
                            </div>
                            <div id="panel1" class="panel-collapse collapse show">
                                <div class="panel-body text-white">
                                    <p>We are located at
                                        San Pedro St, Capisnon, Kauswagan , Cagayan de Oro, Philippines, 9000</p>
                                </div>
                            </div>
                        </div>
                        <div class="panel panel-default mb-3">
                            <div class="panel-heading">
                                <h5 class="panel-title">
                                    <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion"
                                        href="#panel2">What services does KURAW provide? <i
                                            class="fas fa-plus text-white"></i></a>
                                </h5>
                            </div>
                            <div id="panel2" class="panel-collapse collapse">
                                <div class="panel-body text-white">
                                    <p>We provide deliveries, meeting reservations, and dine-in food services.</p>
                                </div>
                            </div>
                        </div>
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h5 class="panel-title">
                                    <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion"
                                        href="#panel3">Where can I contact them? <i
                                            class="fas fa-plus text-white"></i></a>
                                </h5>
                            </div>
                            <div id="panel3" class="panel-collapse collapse">
                                <div class="panel-body text-white">
                                    <p>You can contact us via: <br>
                                        Email : kurawcafe@gmail.com <br>
                                        Phone Number : 0956 165 7495 <br>
                                        FB Page : KURAW
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- end col -->
            </div>
            <!--  end row -->
        </div>
        <!--- END CONTAINER -->
    </section>
    <!-- END TESTIMONIAL & FAQ SECTION -->

    <!-- START PORTFOLIO SECTION -->
    <section id="portfolio" class="section-padding">
        <div class="auto-container">
            <div class="row">
                <div class="col-lg-7 col-md-7 col-12 mx-auto text-center">
                    <div class="section-title">
                        <h2>Image Gallery</h2>
                        <p>Explore the heart of Kuraw Coffee Shop through our Image Gallery, showcasing our cozy
                            ambiance, premium coffee creations, and the memorable moments shared with our customers.
                            From our signature drinks to snapshots of events and milestones, each photo captures the
                            essence of our passion for coffee and connection.</p>
                    </div>
                </div>
            </div>
            <!-- end section title -->
            <div class="row mb-5">
                <div class="col-12 mx-auto text-center wow fadeInDown">
                    <div class="portfolio-filter-menu">
                        <ul>
                            <li class="filter active" data-filter="*">All</li>
                            <li class="filter" data-filter=".one">Food & Drinks</li>
                            <li class="filter" data-filter=".two">Meetings & Small Gatherings</li>
                            <li class="filter" data-filter=".three">Best Moments</li>
                            <li class="filter" data-filter=".four">Location</li>
                        </ul>
                    </div>
                </div>
            </div>
            <!-- end portfolio menu list -->
            <div class="row project-list">
                @foreach (['moments/1.jpg', 'moments/2.jpg', 'kuraw/a.jpg', 'meetings/1.jpg', 'menu/caramelwaffle.jpg', 'menu/iceddirtymatcha.jpg'] as $image)
                    <div class="col-lg-4 col-md-6 col-12 mb-lg-4 mb-md-4 mb-4">
                        <figure class="portfolio-sin-item">
                            <img class="img-fluid" src="{{ asset('assets/img/gallery/' . $image) }}" alt="" />
                            <figcaption>
                                <div class="port-icon mt-3">
                                    <a class="icon-ho venobox" href="{{ asset('assets/img/gallery/' . $image) }}"
                                        data-gall="gall1">
                                        <i class="fas fa-eye"></i>
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

    <!-- START BLOG SECTION -->
    <section id="blog" class="section-padding bg-gray">
        <div class="auto-container">
            <div class="row">
                <div class="col-lg-7 col-md-7 col-12 mx-auto text-center">
                    <div class="section-title">
                        <h2>Latest News</h2>
                        <p>Stay updated with the Latest News from Kuraw Coffee Shop! Discover our newest menu offerings,
                            special promotions, upcoming events, and exciting milestones. Whether it's a new signature
                            drink or an update on our journey, we keep you connected to all things Kuraw.</p>
                    </div>
                </div>
            </div>
            <!-- end section title -->
            <div class="row mb-5">
                <div class="col">
                    <div class="blog-slides owl-carousel owl-theme">
                        <!-- Blog Item 1 -->
                        <div class="blog-home-single">
                            <div class="blog-home-image">
                                <img class="img-fluid" src="{{ asset('assets/img/news/loyaltycard.jpg') }}" alt="" />
                                <div class="blog-home-post-date">
                                    <i class="fas fa-clock"></i>
                                    <span>November 20, 2024</span>
                                </div>
                            </div>
                            <div class="blog-home-des-wrap">
                                <div class="blog-home-des-right">
                                    <div class="havator">
                                        <img class="img-fluid" src="{{ asset('assets/img/testimonial/p1.jpg') }}"
                                            alt="" />
                                    </div>
                                    <div class="blog-home-meta">
                                        <span>Post By <a href="#">KURAW</a></span>
                                    </div>
                                    <div class="blog-home-content">
                                        <h4><a href="#">KURAW’s Loyalty Card for Coffee Connoisseur</a></h4>
                                        <p>Enjoy FREE COFFEE, every after 5 stamps. Grab your favorite coffee, now, to
                                            enjoy the perks.</p>
                                    </div>
                                    <div class="blog-home-btn">
                                        <a href="#"> Read More <i class="fas fa-angle-double-right"></i></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Blog Item 2 -->
                        <div class="blog-home-single">
                            <div class="blog-home-image">
                                <img class="img-fluid" src="{{ asset('assets/img/news/snackcombo.jpg') }}" alt="" />
                                <div class="blog-home-post-date">
                                    <i class="fas fa-clock"></i>
                                    <span>October 9, 2024</span>
                                </div>
                            </div>
                            <div class="blog-home-des-wrap">
                                <div class="blog-home-des-right">
                                    <div class="havator">
                                        <img class="img-fluid" src="{{ asset('assets/img/testimonial/p2.jpg') }}"
                                            alt="" />
                                    </div>
                                    <div class="blog-home-meta">
                                        <span>Post By <a href="#">KURAW</a></span>
                                    </div>
                                    <div class="blog-home-content">
                                        <h4><a href="#">Introducing KURAW’s Snack Combo!</a></h4>
                                        <p>Enjoy your favorite snack & coffee, and save up to P19.</p>
                                    </div>
                                    <div class="blog-home-btn">
                                        <a href="#"> Read More <i class="fas fa-angle-double-right"></i></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Blog Item 3 -->
                        <div class="blog-home-single">
                            <div class="blog-home-image">
                                <img class="img-fluid" src="{{ asset('assets/img/news/close.jpg') }}" alt="" />
                                <div class="blog-home-post-date">
                                    <i class="fas fa-clock"></i>
                                    <span>October 31, 2024</span>
                                </div>
                            </div>
                            <div class="blog-home-des-wrap">
                                <div class="blog-home-des-right">
                                    <div class="havator">
                                        <img class="img-fluid" src="{{ asset('assets/img/testimonial/p3.jpg') }}"
                                            alt="" />
                                    </div>
                                    <div class="blog-home-meta">
                                        <span>Post By <a href="#">KURAW</a></span>
                                    </div>
                                    <div class="blog-home-content">
                                        <h4><a href="#">SCHEDULE</a></h4>
                                        <p>KURAW will be closed on November 1 & 2, 2024, in observance of the “All
                                            Saints & All Souls Day”. See you all on Monday, November 04, 2024.</p>
                                    </div>
                                    <div class="blog-home-btn">
                                        <a href="#"> Read More <i class="fas fa-angle-double-right"></i></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Blog Item 4 -->
                        <div class="blog-home-single">
                            <div class="blog-home-image">
                                <img class="img-fluid" src="{{ asset('assets/img/news/open.jpg') }}" alt="" />
                                <div class="blog-home-post-date">
                                    <i class="fas fa-clock"></i>
                                    <span>March 8, 2024</span>
                                </div>
                            </div>
                            <div class="blog-home-des-wrap">
                                <div class="blog-home-des-right">
                                    <div class="havator">
                                        <img class="img-fluid" src="{{ asset('assets/img/testimonial/p2.jpg') }}"
                                            alt="" />
                                    </div>
                                    <div class="blog-home-meta">
                                        <span>Post By <a href="#">KURAW</a></span>
                                    </div>
                                    <div class="blog-home-content">
                                        <h4><a href="#">KURAW is now officially OPEN!</a></h4>
                                        <p>KURAW is now officially OPEN!</p>
                                    </div>
                                    <div class="blog-home-btn">
                                        <a href="#"> Read More <i class="fas fa-angle-double-right"></i></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--- END CONTAINER -->
    </section>
    <!-- END BLOG SECTION -->

    <!-- Scripts -->
    <script src="{{ asset('assets/js/jquery-2.2.4.min.js') }}"></script>
    <script src="{{ asset('assets/bootstrap/js/popper.min.js') }}"></script>
    <script src="{{ asset('assets/bootstrap/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('assets/js/scripts.js') }}"></script>
    <script src="{{ asset('assets/owlcarousel/js/owl.carousel.min.js') }}"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>
    <script>
        $(document).ready(function () {
            $('.home-slides').owlCarousel({
                items: 1,                 // Number of items to display
                loop: true,               // Enable looping of slides
                autoplay: true,           // Enable autoplay
                autoplayTimeout: 3000,    // Delay between slides (in ms)
                autoplayHoverPause: true, // Pause on hover
                nav: true,                // Enable navigation arrows
                dots: true,               // Enable dots
                navText: ["<", ">"],      // Customize navigation arrows
                responsive: {
                    0: {
                        items: 1
                    },
                    600: {
                        items: 1
                    },
                    1000: {
                        items: 1
                    }
                }
            });
        });
    </script>
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const slides = document.querySelectorAll(".home-single-slide");
            slides.forEach(slide => {
                const backgroundImage = slide.getAttribute("data-background");
                if (backgroundImage) {
                    slide.style.backgroundImage = `url(${backgroundImage})`;
                }
            });
        });
    </script>
</body>

</html>

@endsection