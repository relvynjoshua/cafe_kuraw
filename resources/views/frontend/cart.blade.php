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
    <title>Kuraw - Cart</title>

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

<style>
    /* General Styles */
.card {
    margin-bottom: 1rem;
    overflow-x: auto; /* Enable horizontal scrolling if table is too wide */
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
}

.table-responsive-md {
    display: block;
    width: 100%;
    overflow-x: auto;
    -webkit-overflow-scrolling: touch; /* Enable smooth scrolling on mobile */
}

.table th, 
.table td {
    white-space: nowrap; /* Prevent text wrapping */
    vertical-align: middle; /* Align content vertically */
    font-size: 1rem; /* Default font size */
}

/* Image Styling */
.img-thumbnail {
    width: 60px;
    height: 60px;
    object-fit: cover; /* Ensure image scales correctly */
    border-radius: 5px;
}

/* Button and Input Adjustments */
.btn-sm {
    font-size: 0.875rem; /* Smaller font size for buttons */
    padding: 5px 10px; /* Compact padding for buttons */
}

.form-control-sm {
    font-size: 0.875rem;
    width: 80px; /* Adjust input width */
    display: inline-block; /* Keep inputs inline */
}

/* Responsive Adjustments */
@media (max-width: 768px) {
    /* Adjust Table Layout */
    .table th, 
    .table td {
        font-size: 0.875rem; /* Reduce font size for smaller screens */
    }

    .img-thumbnail {
        width: 50px; /* Reduce image size */
        height: 50px;
    }

    .btn-sm {
        font-size: 0.8rem; /* Further reduce button font size */
    }

    .form-control-sm {
        font-size: 0.8rem; /* Smaller input font size */
        width: 60px; /* Narrow input width */
    }

    .card-header h4 {
        font-size: 1.2rem; /* Adjust heading font size */
    }
}

@media (max-width: 480px) {
    /* Further Adjustments for Small Screens */
    .table th, 
    .table td {
        font-size: 0.75rem; /* Smallest font size for table */
    }

    .img-thumbnail {
        width: 40px; /* Smallest image size */
        height: 40px;
    }

    .btn-sm {
        font-size: 0.75rem; /* Compact buttons */
    }

    .form-control-sm {
        font-size: 0.75rem; /* Compact input */
        width: 50px;
    }

    .card-header h4 {
        font-size: 1rem; /* Smallest heading size */
    }

    /* Table Overflow */
    .table-responsive-md {
        overflow-x: scroll;
    }
}

/* Optional: Center-align empty cart message */
.empty-cart-message {
    text-align: center;
    font-size: 1rem;
    color: #666;
    margin-top: 2rem;
}

    /* Simple modal styling */
    .simple-modal {
        display: none;
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(0, 0, 0, 0.5);
        justify-content: center;
        align-items: center;
        z-index: 1000;
    }

    .simple-modal-content {
        background: white;
        padding: 20px;
        border-radius: 5px;
        max-width: 500px;
        margin: auto;
        text-align: center;
    }

    .simple-close-btn {
        background: transparent;
        border: none;
        font-size: 20px;
        color: black;
        cursor: pointer;
    }

    .simple-close-btn:hover {
        color: red;
    }

    .modal {
        z-index: 1050;
    }

    .modal-backdrop {
        z-index: 1040;
    }

    .invalid-feedback {
        display: block;
        color: #dc3545;
        /* Red color for error */
        font-size: 0.875rem;
    }

    .overlay {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(0, 0, 0, 0.5);
        z-index: 1050;
    }
</style>

<div class="container py-5">
    <h1 class="text-center mb-4"><i class="fas fa-shopping-cart"></i> My Cart</h1>

    <!-- Cart Section -->
    <!-- Flash Messages -->
    @if (session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif
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
                                    <img src="{{ Str::startsWith($item['image'], 'assets/') ? asset($item['image']) : asset('storage/' . $item['image']) }}"
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
                                <form action="{{ route('cart.update') }}" method="POST" class="d-inline" id="updateForm_{{ $id }}">
                                    @csrf
                                    <input type="hidden" name="item_id" value="{{ $id }}">
                                    <input type="number" name="quantity" value="{{ $item['quantity'] }}" min="1"
                                        class="form-control form-control-sm w-auto d-inline" id="quantity_{{ $id }}">
                                    <button type="submit" class="btn btn-sm btn-primary mt-1" id="updateBtn_{{ $id }}">Update</button>
                                </form>

                                <!-- Call Us Notification Modal -->
                                <div class="modal fade" id="callUsModal" tabindex="-1" aria-labelledby="callUsModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="callUsModalLabel">Order Limit Exceeded</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body text-center">
                                                <i class="fas fa-phone-alt text-warning fa-3x mb-3"></i>
                                                <p>You have exceeded the maximum order limit of <br> 10 items. Please <strong>call us</strong> at <strong>0956
                                                        165 7495</strong> to <br> place a larger order.</p>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                <a href="tel:+639561657495" class="btn btn-primary">Call Us</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>

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
                <form action="{{ route('order.store') }}" method="POST" class="mt-3" enctype="multipart/form-data" id="checkoutForm">
                    @csrf
                    <input type="hidden" name="applied_points" id="appliedPoints" value="0">
                    <input type="hidden" name="customer_name" value="{{ auth()->user()->firstname }}">
                    <input type="hidden" name="email" value="{{ auth()->user()->email }}">

                    <!-- Phone -->
                    <div class="mb-3">
                        <label for="phone" class="form-label">Phone</label>
                        <input type="text" name="phone" id="phone" class="form-control @error('phone') is-invalid @enderror"
                            placeholder="Enter your phone number" value="{{ old('phone') }}">
                        @error('phone')
                        <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>


                    <!-- Payment Method -->
                    <div class="mb-3">
                        <label for="payment_method" class="form-label">Payment Method</label>
                        <select name="payment_method" id="payment_method" class="form-select @error('payment_method') is-invalid @enderror" required>
                            <option value="" disabled {{ old('payment_method') ? '' : 'selected' }}>Select a payment method</option>
                            <option value="Gcash" {{ old('payment_method') == 'Gcash' ? 'selected' : '' }}>GCash</option>
                        </select>
                        @error('payment_method')
                        <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <!-- GCash Payment Details -->
                    <div id="gcashDetails" class="{{ old('payment_method') == 'Gcash' ? '' : 'd-none' }}">
                        <h5>GCash Payment</h5>
                        <img src="assets/img/kuraw/gcash.jpg" alt="GCash QR Code" class="img-fluid mb-3 w-20 h-20 mx-auto" />

                        <!-- GCash Reference Number -->
                        <div class="mb-3">
                            <label for="reference_number" class="form-label">GCash Reference Number</label>
                            <input type="text" name="reference_number" id="reference_number"
                                class="form-control @error('reference_number') is-invalid @enderror"
                                placeholder="Enter your GCash reference number (must be a 13-digit number)"
                                value="{{ old('reference_number') }}">
                            @error('reference_number')
                            <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <!-- Proof of Payment -->
                        <div class="mb-3">
                            <label for="proof_of_payment" class="form-label">Upload Proof of Payment</label>
                            <input type="file" name="proof_of_payment" id="proof_of_payment"
                                class="form-control @error('proof_of_payment') is-invalid @enderror">
                            @error('proof_of_payment')
                            <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>

                    <!-- Delivery Method -->
                    <div class="mb-3">
                        <label for="delivery_method" class="form-label">Service Options</label>
                        <select name="delivery_method" id="delivery_method" class="form-select @error('delivery_method') is-invalid @enderror" required>
                            <option value="" disabled {{ old('delivery_method') ? '' : 'selected' }}>Select a service option</option>
                            <option value="pickup" {{ old('delivery_method') == 'pickup' ? 'selected' : '' }}>Pick-Up</option>
                            <option value="delivery" {{ old('delivery_method') == 'delivery' ? 'selected' : '' }}>Delivery</option>
                        </select>
                        @error('delivery_method')
                        <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <!-- Delivery Address -->
                    <div id="address" class="{{ old('delivery_method') == 'delivery' ? '' : 'd-none' }}">
                        <label for="address" class="form-label">Delivery Address</label>
                        <textarea name="address" id="address" class="form-control @error('address') is-invalid @enderror"
                            rows="3" placeholder="Enter your delivery address">{{ old('address') }}</textarea>
                        @error('address')
                        <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <button type="submit" class="btn btn-success w-100" id="placeOrderBtn">Place Order</button>
                </form>


                <!-- Success Notification Modal -->
                <div class="modal fade" id="successModal" tabindex="-1" aria-labelledby="successModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="successModalLabel">Order Confirmation</h5>
                                <button type="button" class="btn-close" id="closeModalBtn" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body text-center">
                                <i class="fas fa-check-circle text-success fa-3x mb-3"></i>
                                <p>Your order has been successfully placed! Your order is currently being processed.</p>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" id="closeModalBtn" data-bs-dismiss="modal">Close</button>
                                <button type="button" class="btn btn-primary" id="confirmOrderBtn">OK</button>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="overlay d-none" id="screenOverlay"></div>

                @else
                <div class="alert alert-warning text-center">
                    <h4>Your cart is empty.</h4>
                    <p><a href="{{ route('menu') }}" class="btn btn-primary mt-3">Browse Menu</a></p>
                </div>
                @endif
            </div>
        </div>


        <script>
    document.addEventListener('DOMContentLoaded', function () {
        const paymentMethodSelect = document.getElementById('payment_method');
        const gcashDetailsSection = document.getElementById('gcashDetails');
        const referenceNumberInput = document.getElementById('reference_number');
        const proofOfPaymentInput = document.getElementById('proof_of_payment');
        const deliveryMethodSelect = document.getElementById('delivery_method');
        const addressField = document.getElementById('address');
        const addressTextarea = addressField.querySelector('textarea');
        const form = document.getElementById('checkoutForm');

        const successModal = new bootstrap.Modal(document.getElementById('successModal'));
        const confirmOrderBtn = document.getElementById('confirmOrderBtn');
        const placeOrderBtn = document.getElementById('placeOrderBtn');
        const screenOverlay = document.getElementById('screenOverlay');

        paymentMethodSelect.addEventListener('change', function () {
            if (this.value === 'Gcash') {
                gcashDetailsSection.classList.remove('d-none');
            } else {
                gcashDetailsSection.classList.add('d-none');
                referenceNumberInput.value = '';
                proofOfPaymentInput.value = '';
                referenceNumberInput.classList.remove('border-red-500', 'border-2');
            }
        });

        deliveryMethodSelect.addEventListener('change', function () {
            if (this.value === 'delivery') {
                addressField.classList.remove('d-none');
                addressTextarea.value = '';
            } else if (this.value === 'pickup') {
                addressField.classList.add('d-none');
                addressTextarea.value = 'Kuraw Cafe';
            }
        });

        if (deliveryMethodSelect.value === 'delivery') {
            addressField.classList.remove('d-none');
        } else {
            addressField.classList.add('d-none');
        }

        form.addEventListener('submit', function (e) {
            e.preventDefault(); // Prevent default form submission

            let hasError = false;

            // Clear previous error messages
            document.querySelectorAll('.invalid-feedback').forEach(function (msg) {
                msg.remove();
            });

            // Validate Phone
            const phoneInput = document.getElementById('phone');
            const phoneError = document.createElement('small');
            phoneError.classList.add('invalid-feedback');

            if (!phoneInput.value.match(/^0[0-9]{10,12}$/)) {
                phoneInput.classList.add('is-invalid');
                phoneError.innerText = 'Please enter a valid phone number. Must be exactly 11 digits.';
                if (!phoneInput.parentElement.contains(phoneError)) {
                    phoneInput.parentElement.appendChild(phoneError);
                }
                hasError = true;
            } else {
                phoneInput.classList.remove('is-invalid');
                if (phoneInput.parentElement.contains(phoneError)) {
                    phoneInput.parentElement.removeChild(phoneError);
                }
            }

            // Validate Payment Method
            if (!paymentMethodSelect.value) {
                paymentMethodSelect.classList.add('is-invalid');
                const paymentError = document.createElement('small');
                paymentError.classList.add('invalid-feedback');
                paymentError.innerText = 'Please select a payment method.';
                paymentMethodSelect.parentElement.appendChild(paymentError);
                hasError = true;
            } else {
                paymentMethodSelect.classList.remove('is-invalid');
            }

            // Validate GCash Reference Number and Proof of Payment
            if (paymentMethodSelect.value === 'Gcash') {
                const referenceNumber = referenceNumberInput.value.trim();
                const proofOfPayment = proofOfPaymentInput.value.trim();

                if (referenceNumber.length !== 13) {
                    referenceNumberInput.classList.add('border-red-500', 'border-2');
                    const refError = document.createElement('small');
                    refError.classList.add('invalid-feedback');
                    refError.innerText = 'GCash Reference Number must be exactly 13 digits.';
                    referenceNumberInput.parentElement.appendChild(refError);
                    hasError = true;
                } else {
                    referenceNumberInput.classList.remove('border-red-500', 'border-2');
                }

                if (!proofOfPayment) {
                    proofOfPaymentInput.classList.add('border-red-500', 'border-2');
                    const proofError = document.createElement('small');
                    proofError.classList.add('invalid-feedback');
                    proofError.innerText = 'Please upload your proof of payment.';
                    proofOfPaymentInput.parentElement.appendChild(proofError);
                    hasError = true;
                } else {
                    proofOfPaymentInput.classList.remove('border-red-500', 'border-2');
                }
            }

            // Validate Delivery Method
            if (!deliveryMethodSelect.value) {
                deliveryMethodSelect.classList.add('is-invalid');
                const deliveryError = document.createElement('small');
                deliveryError.classList.add('invalid-feedback');
                deliveryError.innerText = 'Please select a delivery method.';
                deliveryMethodSelect.parentElement.appendChild(deliveryError);
                hasError = true;
            } else {
                deliveryMethodSelect.classList.remove('is-invalid');
            }

            // Validate Address (if Delivery is selected)
            if (deliveryMethodSelect.value === 'delivery' && !addressTextarea.value.trim()) {
                addressTextarea.classList.add('is-invalid');
                const addressError = document.createElement('small');
                addressError.classList.add('invalid-feedback');
                addressError.innerText = 'Please provide a delivery address.';
                addressTextarea.parentElement.appendChild(addressError);
                hasError = true;
            } else {
                addressTextarea.classList.remove('is-invalid');
            }

            // If there is an error, stop the form from submitting
            if (hasError) {
                return;
            }

            // Show the modal
            successModal.show();
        });

        confirmOrderBtn.addEventListener('click', function () {
            // Disable the screen
            screenOverlay.classList.remove('d-none');

            // Submit the form when "OK" is clicked
            form.submit();
        });

        // Quantity Update exceeds 10
        const updateBtns = document.querySelectorAll('button[id^="updateBtn_"]');
        updateBtns.forEach(function (btn) {
            btn.addEventListener('click', function (e) {
                const form = this.closest('form'); // Get the form
                const quantityInput = form.querySelector('input[name="quantity"]'); // Get the quantity input
                const quantity = parseInt(quantityInput.value, 10); // Get the entered quantity

                // If quantity exceeds 10, prevent form submission and show modal
                if (quantity > 9) {
                    e.preventDefault(); // Prevent form submission
                    const callUsModal = new bootstrap.Modal(document.getElementById('callUsModal'));
                    callUsModal.show(); // Show the modal
                }
            });
        });
    });
</script>



        <script src="{{ asset('assets/bootstrap/js/bootstrap.min.js') }}"></script>
        <script src="{{ asset('assets/js/main.js') }}"></script>
        @endsection