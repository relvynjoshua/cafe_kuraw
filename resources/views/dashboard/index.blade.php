@extends('layouts.dashboard')

@section('title', 'Admin')

@section('content')
<div class="dashboard-overview">
        <h1>Welcome to the Dashboard</h1>

        <div class="stats">
            <div class="stat">
                <h2>Products</h2>
                <p>{{ $totalProducts }} items</p>
            </div>
            <div class="stat">
                <h2>Supplier</h2>
                <p>{{ $totalSuppliers }} suppliers</p>
            </div>
            <div class="stat">
                <h2>Customers</h2>
                <p>{{ $totalCustomers }} people</p>
            </div>
            <div class="stat">
                <h2>Categories</h2>
                <p>{{ $totalCategories }} categories</p>
            </div>
            <div class="stat">
                <h2>Reservations</h2>
                <p>{{ $totalReservations }} reservations</p>
            </div>
        </div>  
    </div>
@endsection
