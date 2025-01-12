@extends('layouts.app')

@section('title', 'Order Details')

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
    <title>Order Details</title>

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
    <div class="p-4 border rounded-lg shadow">
        <h2 class="font-bold text-lg mb-2">Order Details</h2>
        <p><strong>Order ID:</strong> {{ $order->id }}</p>
        <p><strong>Date:</strong> {{ $order->created_at->format('F d, Y h:i A') }}</p>
        <p><strong>Status:</strong>
            <span class="badge bg-{{ $order->status === 'completed' ? 'success' : ($order->status === 'pending' ? 'warning' : 'danger') }}">
                {{ ucfirst($order->status) }}
            </span>
        </p>
        <p><strong>Total Amount:</strong> ₱{{ number_format($order->total_amount, 2) }}</p>
        <p><strong>Discount Applied:</strong> ₱{{ number_format($order->discount ?? 0, 2) }}</p>

        <h4 class="mt-4 font-semibold">Order Items</h4>
        <ul class="list-disc ml-6">
            @foreach ($order->products as $product)
                <li>
                    {{ $product->name }} - {{ $product->pivot->quantity }} x 
                    ₱{{ number_format($product->pivot->price, 2) }} 
                    @if ($product->pivot->variation)
                        ({{ $product->pivot->variation }})
                    @endif
                </li>
            @endforeach
        </ul>

    <a href="{{ route('orders.index') }}" class="btn btn-dark mt-4">Back to Orders</a>
</div>
@endsection
