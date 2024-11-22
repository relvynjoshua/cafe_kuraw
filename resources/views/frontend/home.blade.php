@extends('layouts.test')

@section('title', 'Home Page')

@section('content')
    <style>
        .home {
            max-width: 2500px; /* Adjust max-width to your needs */
            background-color: #967259;
            margin: auto;
            padding: 15px;
            border-radius: 20px;
            box-sizing: border-box;
        }
        .home-text {
            color: white;
        }
        .home-img {
            width: 100%;
            border-radius: 20px;
            object-fit: cover;
        }
    </style>



    <!-- Home Section -->
    <section class="home">
        <div class="row align-items-center">
            <!-- Text Column -->
            <div class="home-text text-justify col-md-6">
                <h4>Welcome to Kuraw Coffee Shop!</h4>
                <h1>Kuraw ta kape!</h1>
                <p>A coffee shop in San Pedro Street, Capinson, Cagayan de Oro City - with an assortment of drinks and foods the customer can order. Kuraw na ta!</p>
            </div>

            <!-- Image Column -->
            <div class="col-md-6">
                <img src="{{ asset('img/espresso_based/cappucinno.jpg') }}" alt="Kuraw Coffee Shop" class="home-img">
            </div>
        </div>
    </section>
@endsection
