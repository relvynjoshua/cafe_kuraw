@extends('layouts.app')

@section('title', 'My Profile')

@section('content')
<!-- Profile CSS -->
<link rel="stylesheet" href="{{ asset('assets/css/profile.css') }}">

<div class="container py-5">
    <div class="row">
        <div class="col-lg-9 mx-auto">
            <div class="card shadow">
                <div class="card-header bg-secondary text-white d-flex align-items-center">
                    <i class="fas fa-user-circle fa-3x me-3"></i>
                    <h3 class="mb-0">My Profile</h3>
                </div>
                <div class="card-body">
                    <!-- User Details -->
                    <div class="mb-3">
                        <h5 class="text-secondary">User Details</h5>
                        <hr>
                        <p><strong>Name:</strong> {{ $user->firstname }}</p>
                        <p><strong>Email:</strong> {{ $user->email }}</p>
                    </div>

                    <!-- Edit Button -->
                    <a href="{{ route('profile.edit') }}" class="btn btn-dark w-100">Edit Settings</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
