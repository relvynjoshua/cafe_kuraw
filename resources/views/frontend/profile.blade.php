@extends('layouts.app')

@section('title', 'My Profile')

@section('content')
<!-- Profile CSS -->
<link rel="stylesheet" href="{{ asset('assets/css/profile.css') }}">
<!-- Bootstrap core CSS -->
<link href="{{ asset('assets/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
<!-- Google Fonts -->
<link
    href="https://fonts.googleapis.com/css?family=Dosis:300,400,500,600,700,800|Roboto:300,400,400i,500,500i,700,700i,900,900i"
    rel="stylesheet">
<!-- Font Awesome -->
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
<!-- Meanmenu CSS -->

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


<div class="container py-5">
    <div class="row">
        <div class="col-lg-9 mx-auto">
            <div class="card shadow">
                <div class="card-header bg-secondary text-white d-flex align-items-center">
                    <i class="fas fa-user-circle fa-3x me-3"></i>
                    <h3 class="mb-0">My Profile</h3>
                </div>
                <div class="card-body">
                    <!-- User Details -->
                    <div class="mb-3">
                        <h5 class="text-secondary">User Details</h5>
                        <hr>
                        <p><strong>Name:</strong> {{ $user->firstname }}</p>
                        <p><strong>Email:</strong> {{ $user->email }}</p>
                    </div>

                    <!-- Edit Button -->
                    <a href="{{ route('profile.edit') }}" class="btn btn-dark w-100">Edit Settings</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection