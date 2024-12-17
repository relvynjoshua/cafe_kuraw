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
   </style>
</head>

<div class="container my-2">
   <div class="page-banner page-banner-overlay">
      <div class="container h-100">
         <div class="row h-100">
            <div class="col-lg-12 my-auto">
               <div class="page-banner-content text-center">
                  <h2 class="page-banner-title">Menu</h2>
                  <div class="page-banner-breadcrumb">
                     <p><a href="{{ route('home') }}">Home</a> Menu</p>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>

<!-- Menu Section -->
<div class="container my-5">
   <div class="row">
      @foreach ($products as $product)
        <div class="col-md-4">
          <div class="card product-card mb-4 shadow-sm">
            <!-- Product Image -->
            <div class="card-img-container">
               <img src="{{ asset('storage/' . $product->image) }}" class="card-img-top rounded-top"
                 alt="{{ $product->name }}">
            </div>

            <!-- Product Details -->
            <div class="card-body">
               <h5 class="card-title text-center">{{ $product->name }}</h5>
               <p class="card-text text-muted text-center">{{ $product->description }}</p>
               <p class="card-text text-center">
                 <strong>Base Price:</strong> ₱{{ number_format($product->price, 2) }}
               </p>

               <!-- Product Variations -->
               @if ($product->variations->count() > 0)
               <div class="mb-3">
                <label for="variation_{{ $product->id }}" class="form-label">Choose Variation</label>
                <select class="form-select" id="variation_{{ $product->id }}" name="variation_id">
                  @foreach ($product->variations as $variation)
                 <option value="{{ $variation->id }}">
                  {{ $variation->type }} - {{ $variation->value }}
                  (₱{{ number_format($variation->price, 2) }})
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
                     class="form-control w-75">
                 </div>
                 <button type="button"
                   onclick="addToCart({{ $product->id }}, {{ $product->variations->first()->id ?? 0 }})"
                   class="btn btn-primary rounded-pill">
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

<!-- Latest jQuery -->
<script>
   function addToCart(productId, variationId) {
      const quantity = document.querySelector(`#quantity_${productId}`).value || 1;

      fetch('{{ route('cart.add') }}', {
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

               // Show Modal
               const addToCartModal = new bootstrap.Modal(document.getElementById('addToCartModal'));
               addToCartModal.show();
            } else {
               alert(data.message);
            }
         })
         .catch(error => console.error('Error:', error));
   }
</script>

<script>
   document.addEventListener('DOMContentLoaded', function () {
      // Ensure the hidden input is updated when the variation dropdown changes
      document.querySelectorAll('select[name="variation_id"]').forEach(select => {
         select.addEventListener('change', function () {
            const productId = this.id.split('_')[1];
            const hiddenInput = document.getElementById('selected_variation_' + productId);

            if (hiddenInput) {
               hiddenInput.value = this.value; // Update hidden input with the selected variation ID
            }
         });

         // Trigger change event on page load to set the initial value
         select.dispatchEvent(new Event('change'));
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