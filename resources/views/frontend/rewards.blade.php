@extends('layouts.app')

@section('title', 'My Rewards')

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
    <title>Kuraw - Rewards</title>

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

<!-- Profile CSS -->
<link rel="stylesheet" href="{{ asset('assets/css/profile.css') }}">

<div class="container py-5">
    <div class="row">
        <div class="col-lg-9 mx-auto">
            <div class="card shadow">
                <div class="card-header bg-secondary text-white d-flex align-items-center">
                    <i class="fas fa-gift fa-3x me-3"></i>
                    <h3 class="mb-0">My Rewards</h3>
                </div>
                <div class="card-body">
                    <!-- Reward Points -->
                    <div class="mb-3">
                        <h5 class="text-secondary">Reward Points</h5>
                        <hr>
                        <p><strong>Available Points:</strong> {{ $user->reward_points }}</p>

                        <!-- Redeem Points Form -->
                        <form method="POST" action="{{ route('rewards.redeem') }}">
                            @csrf
                            <div class="mb-3">
                                <label for="points" class="form-label">Redeem Points</label>
                                <input type="number" name="points" id="points" class="form-control"
                                    placeholder="Enter points to redeem" min="1" max="{{ $user->reward_points }}"
                                    required>
                            </div>
                            <button type="submit" class="btn btn-primary w-100">Redeem Points</button>
                        </form>

                        <!-- Display Success or Error Messages -->
                        @if(session('success'))
                            <div class="alert alert-success mt-3">{{ session('success') }}</div>
                        @endif
                        @if($errors->any())
                            <div class="alert alert-danger mt-3">{{ $errors->first() }}</div>
                        @endif
                    </div>

                    <!-- Points Usage History -->
                    <div class="mb-3">
                        <h5 class="text-secondary">Points History</h5>
                        <hr>
                        @if($pointsHistory->isEmpty())
                            <p class="text-center">No points history available.</p>
                        @else
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>Date</th>
                                        <th>Activity</th>
                                        <th>Points</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($pointsHistory as $history)
                                        <tr>
                                            <td>{{ $history->created_at->format('Y-m-d') }}</td>
                                            <td>{{ $history->activity }}</td>
                                            <td>{{ $history->points }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection