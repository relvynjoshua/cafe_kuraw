@extends('layouts.dashboard')

@section('content')

<style>
    .profile-container {
        max-width: 800px; /* Increased from 600px to 800px */
        margin: 0 auto;
        padding: 20px;
        background-color: #ffffff;
        border-radius: 10px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }

    .profile-header {
        text-align: center;
        margin-bottom: 20px;
    }

    .profile-header h1 {
        font-size: 2.5rem; /* Increased font size slightly */
        color: #333;
    }

    .profile-details {
        font-size: 1.2rem; /* Slightly increased font size */
        color: #555;
    }

    .profile-details p {
        margin: 10px 0;
        padding: 15px; /* Increased padding */
        background-color: #f9f9f9;
        border-radius: 5px;
    }

    .profile-details strong {
        display: inline-block;
        min-width: 180px; /* Increased min-width */
        font-weight: 600;
        color: #333;
    }
</style>

<div class="container mt-4">
    <div class="profile-container">
        <div class="profile-header">
            <h1>Admin Profile</h1>
        </div>
        <div class="profile-details">
            <p><strong>Name:</strong> {{ $user->firstname }}</p>
            <p><strong>Email:</strong> {{ $user->email }}</p>
        </div>
    </div>
</div>

@endsection
