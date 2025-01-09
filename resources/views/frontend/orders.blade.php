@extends('layouts.app')

@section('title', 'My Orders')

@section('content')

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
    <title>My Orders</title>

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

<div class="container py-5">
    <h1 class="text-center mb-4"><i class="fas fa-box"></i> My Orders</h1>

    @if ($orders->isNotEmpty())
        <div class="space-y-4">
            @foreach ($orders as $order)
                <div class="border rounded-lg shadow p-4 hover:bg-gray-50 transition">
                    <a href="{{ route('orders.showDetails', $order->id) }}"
                        class="flex justify-between items-center text-decoration-none text-dark">
                        <div>
                            <h4 class="font-semibold">Order #{{ $order->id }}</h4>
                            <p class="text-sm text-gray-500">Date: {{ $order->created_at->format('F d, Y h:i A') }}</p>
                            <p class="text-sm">
                                Status:
                                <span
                                    class="badge bg-{{ $order->status === 'completed' ? 'success' : ($order->status === 'pending' ? 'warning' : 'danger') }}">
                                    {{ ucfirst($order->status) }}
                                </span>
                            </p>
                        </div>
                        <div class="text-lg font-bold">₱{{ number_format($order->total_amount, 2) }}</div>
                    </a>
                    @if ($order->isCancelable())
                        <form method="POST" action="{{ route('orders.cancel', $order->id) }}" class="mt-2">
                            @csrf
                            <button type="submit" class="btn btn-danger btn-sm">Cancel Order</button>
                        </form>
                    @endif
                </div>
            @endforeach
        </div>
    @else
        <div class="alert alert-warning text-center">
            <h4>No orders found.</h4>
            <p>You have not placed any orders yet. <a href="{{ route('menu') }}" class="text-primary">Start shopping</a>.
            </p>
        </div>
    @endif
</div>

<!-- Scripts -->
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