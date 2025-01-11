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
                <div
                    class="border rounded-lg shadow p-4 hover:bg-gray-50 transition d-flex justify-content-between align-items-start mb-4">
                    <!-- Add mb-4 for space between orders -->
                    <div class="flex-grow-1">
                        <h4 class="font-semibold">Order #{{ $order->id }}</h4>
                        <p class="text-sm text-gray-500">Date: {{ $order->created_at->format('F d, Y h:i A') }}</p>
                        <p class="text-sm">
                            Status:
                            <span
                                class="badge bg-{{ $order->status === 'completed' ? 'success' : ($order->status === 'pending' ? 'warning' : 'danger') }}">
                                {{ ucfirst($order->status) }}
                            </span>
                        </p>
                        <div class="text-lg font-bold me-3">₱{{ number_format($order->total_amount, 2) }}</div>
                    </div>

                    <!-- Buttons Section aligned to the right with margin-top -->
                    <div class="d-flex flex-column align-items-end mt-3"> <!-- Add mt-3 for spacing above the buttons -->
                        <button class="btn btn-primary btn-sm mb-2" style="width: 100px;" data-bs-toggle="modal"
                            data-bs-target="#orderDetailsModal" onclick="fetchOrderDetails('{{ $order->id }}')">View
                            Details</button>

                        @if ($order->isCancelable())
                            <form method="POST" action="{{ route('orders.cancel', $order->id) }}" class="mt-2">
                                @csrf
                                <button type="submit" class="btn btn-danger btn-sm">Cancel Order</button>
                            </form>
                        @endif
                    </div>
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




<div class="modal fade" id="orderDetailsModal" tabindex="-1" aria-labelledby="orderDetailsModal"
    aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="orderDetailsModal">Order Details</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="mb-3">
                    <h6>Order Status: <span id="modalOrderStatus" class="badge"></span></h6>
                    <h6>Order Date: <span id="modalOrderDate"></span></h6>
                </div>
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Product Name</th>
                            <th>Variation</th>
                            <th>Quantity</th>
                            <th>Unit Price</th>
                            <th>Total</th>
                        </tr>
                    </thead>
                    <tbody id="modalProducts"></tbody>
                </table>
            </div>
        </div>
    </div>
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
<script src="{{ asset('assets/js/notif-customer.js') }}"></script>

@endsection