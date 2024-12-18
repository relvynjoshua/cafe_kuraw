@extends('layouts.app')

@section('title', 'Cart')

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
    <title>Cart</title>

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
    <h1 class="text-center mb-4"><i class="fas fa-shopping-cart"></i> My Cart</h1>

    <!-- Toggle Buttons -->
    <div class="text-center mb-4">
        <button data-toggle="cartSection" class="btn btn-primary">View Cart</button>
        <button data-toggle="orderHistorySection" class="btn btn-secondary">View Order History</button>
    </div>

    <!-- Cart Section -->
    <div id="cartSection" class="toggle-section">
        @if ($cart && count($cart) > 0)
            <!-- Cart Items Table -->
            <div class="card shadow-sm mb-4">
                <div class="card-header bg-dark">
                    <h4 class="mb-0 text-white">Your Cart Items</h4>
                </div>
                <div class="card-body">
                    <table class="table table-responsive-md">
                        <thead class="table-light">
                            <tr>
                                <th>Product</th>
                                <th>Price</th>
                                <th>Quantity</th>
                                <th>Total</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($cart as $id => $item)
                                <tr>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <img src="{{ asset('storage/' . ($item['image'] ?? 'default.jpg')) }}"
                                                alt="{{ $item['name'] }}" class="img-thumbnail me-3"
                                                style="width: 60px; height: 60px;">
                                            <div>
                                                <p class="mb-0 fw-bold">{{ $item['name'] }}</p>
                                                @if (!empty($item['variation']))
                                                    <small class="text-muted">Variation: {{ $item['variation'] }}</small>
                                                @endif
                                            </div>
                                        </div>
                                    </td>
                                    <td>₱{{ number_format($item['price'], 2) }}</td>
                                    <td>
                                        <form action="{{ route('cart.update') }}" method="POST" class="d-inline">
                                            @csrf
                                            <input type="hidden" name="item_id" value="{{ $id }}">
                                            <input type="number" name="quantity" value="{{ $item['quantity'] }}" min="1"
                                                class="form-control form-control-sm w-auto d-inline">
                                            <button type="submit" class="btn btn-sm btn-primary mt-1">Update</button>
                                        </form>
                                    </td>
                                    <td>₱{{ number_format($item['price'] * $item['quantity'], 2) }}</td>
                                    <td>
                                        <form action="{{ route('cart.remove') }}" method="POST" class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <input type="hidden" name="item_id" value="{{ $id }}">
                                            <button type="submit" class="btn btn-sm btn-danger">
                                                <i class="fas fa-trash"></i> Remove
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Order Summary -->
            <div class="card shadow-sm">
                <div class="card-header bg-secondary text-white">
                    <h4 class="mb-0">Order Summary</h4>
                </div>
                <div class="card-body text-center">
                    <h5>Total Price: ₱<span id="totalPrice">{{ number_format($totalPrice, 2) }}</span></h5>
                    <div class="mt-3">
                        <label for="discountInput" class="form-label">Apply Reward Points:</label>
                        <input type="number" id="discountInput" class="form-control d-inline w-25" min="0"
                            max="{{ auth()->user()->reward_points }}" placeholder="Enter points">
                        <h5 class="text-danger mt-3">Discount Applied: ₱<span
                                id="discountDisplay">{{ number_format($discount, 2) }}</span></h5>
                        <h5 class="text-success mt-3">Final Price: ₱<span
                                id="finalPrice">{{ number_format($finalPrice, 2) }}</span></h5>
                    </div>
                    <p><strong>Available Reward Points:</strong> {{ auth()->user()->reward_points }}</p>

                    <!-- Checkout Form -->
                    <form action="{{ route('order.store') }}" method="POST" class="mt-3" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="applied_points" id="appliedPoints" value="0">
                        <input type="hidden" name="customer_name" value="{{ auth()->user()->firstname }}">
                        <input type="hidden" name="email" value="{{ auth()->user()->email }}">
                        <div class="mb-3">
                            <label for="phone" class="form-label">Phone</label>
                            <input type="text" name="phone" id="phone" class="form-control"
                                placeholder="Enter your phone number" required>
                        </div>
                        <div class="mb-3">
                            <label for="payment_method" class="form-label">Payment Method</label>
                            <select name="payment_method" id="payment_method" class="form-select" required>
                                <option value="" disabled selected>Select a payment method</option>
                                <option value="credit_card">Credit Card</option>
                                <option value="paypal">Paypal</option>
                                <option value="gcash">GCash</option>
                            </select>
                        </div>

                        <!-- GCash Payment Details (Hidden by Default) -->
                        <div id="gcashDetails" class="d-none">
                            <h5>GCash Payment</h5>
                            <img src="assets/img/kuraw/qr-code.jpg" alt="GCash QR Code"
                                class="img-fluid mb-3 w-20 h-20 mx-auto" />

                            <div class="mb-3">
                                <label for="gcash_reference_number" class="form-label">GCash Reference Number</label>
                                <input type="text" name="gcash_reference_number" id="gcash_reference_number"
                                    class="form-control" placeholder="Enter your GCash reference number" />
                            </div>

                            <div class="mb-3">
                                <label for="gcash_proof" class="form-label">Upload Proof of Payment</label>
                                <input type="file" name="gcash_proof" id="gcash_proof" class="form-control" />
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="delivery_method" class="form-label">Delivery Method</label>
                            <select name="delivery_method" id="delivery_method" class="form-select" required>
                                <option value="" disabled selected>Select a delivery method</option>
                                <option value="pickup">Pick-Up</option>
                                <option value="delivery">Delivery</option>
                            </select>
                        </div>

                        <!-- Delivery Address (Initially Hidden) -->
                        <div id="addressField" class="mb-3" style="display:none;">
                            <label for="delivery_address" class="form-label">Delivery Address</label>
                            <textarea name="delivery_address" id="delivery_address" class="form-control" rows="3"
                                placeholder="Enter your delivery address"></textarea>
                        </div>

                        <button type="submit" class="btn btn-success w-100">Place Order</button>
                    </form>
                </div>
            </div>
        @else
            <div class="alert alert-warning text-center">
                <h4>Your cart is empty.</h4>
                <p><a href="{{ route('menu') }}" class="btn btn-primary mt-3">Browse Menu</a></p>
            </div>
        @endif
    </div>
</div>

<!-- JavaScript -->
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const paymentMethodSelect = document.getElementById('payment_method');
        const gcashDetailsSection = document.getElementById('gcashDetails');
        const referenceNumberInput = document.getElementById('gcash_reference_number');
        const deliveryMethodSelect = document.getElementById('delivery_method');
        const addressField = document.getElementById('addressField');
        const form = document.querySelector('form'); // The checkout form

        // Show/Hide the GCash details section when the payment method is changed
        paymentMethodSelect.addEventListener('change', function () {
            if (this.value === 'gcash') {
                gcashDetailsSection.classList.remove('d-none');
            } else {
                gcashDetailsSection.classList.add('d-none');
            }
        });

        // Show/Hide the address input based on the selected delivery method
        deliveryMethodSelect.addEventListener('change', function () {
            if (this.value === 'delivery') {
                addressField.style.display = 'block';
            } else {
                addressField.style.display = 'none';
            }
        });

        // Form submission validation
        form.addEventListener('submit', function (e) {
            const referenceNumber = referenceNumberInput.value.trim();
            if (paymentMethodSelect.value === 'gcash') {
                // Check if the reference number is exactly 13 characters
                if (referenceNumber.length !== 13) {
                    e.preventDefault(); // Prevent form submission
                    alert('The GCash reference number must be exactly 13 characters.');

                    // Add the red border to the reference number input
                    referenceNumberInput.classList.add('border-red-500', 'border-2');
                    referenceNumberInput.focus();
                } else {
                    // Remove red border if the reference number is valid
                    referenceNumberInput.classList.remove('border-red-500', 'border-2');
                }
            }
        });

        // Optional: Real-time validation (while typing)
        referenceNumberInput.addEventListener('input', function () {
            if (referenceNumberInput.value.trim().length !== 13) {
                referenceNumberInput.classList.add('border-red-500', 'border-2');
            } else {
                referenceNumberInput.classList.remove('border-red-500', 'border-2');
            }
        });
    });
</script>

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