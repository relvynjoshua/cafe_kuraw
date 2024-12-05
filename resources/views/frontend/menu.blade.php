@extends('layouts.app')

@section('title', 'Menu')

@section('content')
<!-- Add custom CSS -->
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

<div class="container my-2">
    <div class="page-banner page-banner-overlay" data-background="{{ asset('assets/img/menu/cover.jpg') }}">
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

                        <!-- Add to Cart Form -->
                        <form action="{{ route('cart.add') }}" method="POST">
                            @csrf
                            <input type="hidden" name="product_id" value="{{ $product->id }}">
                            <input type="hidden" id="selected_variation_{{ $product->id }}" name="variation_id" value="">
                            <div class="d-flex justify-content-between align-items-center">
                                <div>
                                    <label for="quantity_{{ $product->id }}" class="form-label">Quantity</label>
                                    <input type="number" id="quantity_{{ $product->id }}" name="quantity" value="1" min="1"
                                        class="form-control w-75">
                                </div>
                                <button type="submit" class="btn btn-primary rounded-pill">Add to Cart</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>

<!-- Custom Script for Variations -->
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

@endsection