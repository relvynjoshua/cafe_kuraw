@extends('layouts.app')

@section('title', 'Menu')

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
   <title>Menu</title>

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

   <style>
      .product-card {
         border-radius: 12px;
         overflow: hidden;
         transition: transform 0.3s, box-shadow 0.3s;
      }

      .product-card:hover {
         transform: scale(1.05);
         box-shadow: 0 8px 20px rgba(0, 0, 0, 0.15);
      }

      .card-img-container {
         height: 200px;
         overflow: hidden;
         display: flex;
         justify-content: center;
         align-items: center;
      }

      .card-img-container img {
         max-height: 100%;
         max-width: 100%;
         object-fit: cover;
      }

      .card-body {
         background-color: #f8f9fa;
         padding: 1.5rem;
      }

      .card-title {
         font-size: 1.25rem;
         font-weight: 600;
         color: #333;
      }

      .card-text {
         font-size: 0.9rem;
      }

      .btn-primary {
         background-color: #000000;
         border: none;
      }

      .btn-primary:hover {
         color: #ffff;
         background-color: #333;
      }

      .modal {
         z-index: 1050;
      }

      .modal-backdrop {
         z-index: 1040;
      }

      .container.my-4 {
         display: flex;
         justify-content: center;
         flex-wrap: wrap;
         gap: 10px;
         margin-bottom: 20px;
      }

      .container.my-4 a {
         text-decoration: none;
         padding: 10px 15px;
         border-radius: 20px;
         background-color: #f8f9fa;
         color: #000;
         font-weight: 600;
         transition: background-color 0.3s;
         white-space: nowrap;
      }

      .container.my-4 a:hover {
         background-color: #333;
         color: #fff;
      }

      .container.my-4 a.active {
         background-color: #333;
         color: #fff;
      }

      @media (max-width: 768px) {
         .container.my-4 a {
            font-size: 0.85rem;
            padding: 8px 12px;
         }

         .card-title {
            font-size: 1rem;
         }

         .card-body {
            padding: 1rem;
         }
      }

      @media (max-width: 576px) {
         .container.my-4 {
            flex-direction: column;
            align-items: center;
         }

         .container.my-4 a {
            width: 100%;
            text-align: center;
         }

         .col-md-4 {
            flex: 0 0 100%;
            max-width: 100%;
         }

         .btn-primary {
            width: 100%;
         }
      }
   </style>
</head>

<div class="container my-2">
   <div class="page-banner page-banner-overlay">
      <div class="container h-100">
         <div class="row h-100">
            <div class="col-lg-12 my-auto">
               <div class="page-banner-content text-center">
                  <h2 class="page-banner-title">Menu</h2>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>

<!-- Menu Categories -->
<div class="container my-4">
   @php
   $categories = [
   1 => 'Espresso-Based Coffee',
   2 => 'Milktea',
   3 => 'Non-Coffee',
   4 => 'Snacks',
   5 => 'Waffle',
   6 => 'Ramen'
   ];
   @endphp
   <a href="{{ url('/menu') }}" class="{{ is_null($selectedCategory) ? 'active' : '' }}">All</a>
   @foreach ($categories as $id => $name)
   <a href="{{ url('/menu/category/' . $id) }}" class="{{ $id == $selectedCategory ? 'active' : '' }}">{{ $name }}</a>
   @endforeach
</div>

<!-- Menu Section -->
<div class="container my-5">
   <div class="row">
      @foreach ($products as $product)
      <div class="col-md-4">
         <div class="card product-card mb-4 shadow-sm">
            <!-- Product Image -->
            <div class="card-img-container">
               <img
                  src="{{ Str::startsWith($product->image, 'assets/') ? asset($product->image) : asset('storage/' . $product->image) }}"
                  class="card-img-top rounded-top" alt="{{ $product->name }}">
            </div>

            <!-- Product Details -->
            <div class="card-body">
               <h5 class="card-title text-center">{{ $product->name }}</h5>
               <p class="card-text text-muted text-center">{{ $product->description }}</p>
               <p class="card-text text-center">
                  <strong>Base Price:</strong> ₱{{ number_format($product->price, 2) }}
               </p>

               <!-- Variations Dropdown -->
               @if ($product->variations->isNotEmpty())
               <div class="mb-3">
                  <label for="variation_{{ $product->id }}" class="form-label">Select Variation:</label>
                  <select id="variation_{{ $product->id }}" class="form-select">
                     @foreach ($product->variations as $variation)
                     <option value="{{ $variation->id }}" data-price="{{ $variation->price }}">
                        {{ $variation->value }} ({{ $variation->type }}) - ₱{{ number_format($variation->price, 2) }}
                     </option>
                     @endforeach
                  </select>
               </div>
               @endif

               <!-- Add to Cart Button -->
               <div class="d-flex justify-content-between align-items-center">
                  <div>
                     <label for="quantity_{{ $product->id }}" class="form-label">Quantity</label>
                     <input type="number" id="quantity_{{ $product->id }}" name="quantity" value="1" min="1"
                        class="form-control w-75" oninput="validateQuantity(this)">
                  </div>
                  <button type="button" onclick="addToCart({{ $product->id }})" class="btn btn-primary rounded-pill">
                     Add to Cart
                  </button>
               </div>

            </div>
         </div>
      </div>
      @endforeach
   </div>
</div>

<!-- Add to Cart Notification Modal -->
<div class="modal fade" id="addToCartModal" tabindex="-1" aria-labelledby="addToCartModalLabel" aria-hidden="true">
   <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
         <div class="modal-header">
            <h5 class="modal-title" id="addToCartModalLabel">Item Added to Cart</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
         </div>
         <div class="modal-body text-center">
            <i class="fas fa-check-circle text-success fa-3x mb-3"></i>
            <p>Your item has been successfully added to the cart!</p>
         </div>
         <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Continue Shopping</button>
            <a href="{{ url('/cart') }}" class="btn btn-primary">Go to Cart</a>
         </div>
      </div>
   </div>
</div>

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
            <p>You have exceeded the maximum order limit of 10 items. Please <strong>call us</strong> at <strong>0956
                  165 7495</strong> to place a larger order.</p>
         </div>
         <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            <a href="tel:+639561657495" class="btn btn-primary">Call Us</a>
         </div>
      </div>
   </div>
</div>

<script src="{{ asset('assets/bootstrap/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('assets/js/main.js') }}"></script>
<script>
   function addToCart(productId) {
      const quantity = document.querySelector(`#quantity_${productId}`).value || 1;
      const variationSelect = document.querySelector(`#variation_${productId}`);
      const variationId = variationSelect ? variationSelect.value : null; // Get the selected variation ID if it exists

      fetch("{{ route('cart.add') }}", {
            method: 'POST',
            headers: {
               'Content-Type': 'application/json',
               'X-CSRF-TOKEN': '{{ csrf_token() }}',
            },
            body: JSON.stringify({
               product_id: productId,
               variation_id: variationId,
               quantity: quantity,
            }),
         })
         .then(response => response.json())
         .then(data => {
            if (data.status === 'success') {
               // Update Cart Badge
               document.querySelector('#cart-badge').innerText = data.cart_count;

               // Show Modal Explicitly
               const addToCartModal = new bootstrap.Modal(document.getElementById('addToCartModal'));
               addToCartModal.show();
            } else if (data.status === 'error' && data.message.includes('You cannot order more than')) {
               // Show "Call Us" Modal
               const callUsModal = new bootstrap.Modal(document.getElementById('callUsModal'));
               callUsModal.show();
            }
         })
         .catch(error => console.error('Error:', error));
   }

   function validateQuantity(input) {
      if (input.value < 1) {
         input.value = 1; // Reset to 1 if the value is less than the minimum
      }
   }
</script>

@endsection