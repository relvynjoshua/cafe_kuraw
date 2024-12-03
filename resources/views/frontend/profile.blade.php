@extends('layouts.app')

@section('title', 'My Profile')

@section('content')
<div class="container py-5">
    <h1 class="mb-4">My Profile</h1>
    
    <!-- User Information -->
    <div class="card mb-4">
        <div class="card-header">
            <h2>User Details</h2>
        </div>
        <div class="card-body">
            <p><strong>Name:</strong> {{ $user->firstname }}</p>
            <p><strong>Email:</strong> {{ $user->email }}</p>
        </div>
    </div>

    
</div>
@endsection
