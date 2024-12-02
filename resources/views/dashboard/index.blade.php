@extends('layouts.dashboard')

@section('title', 'Admin Dashboard')

@section('content')

<style>
    .dashboard-overview {
        background-color: #f9f9f9;
        padding: 20px;
        border-radius: 8px;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        margin-bottom: 20px;;
    }

    .dashboard-overview h1 {
        font-size: 2rem;
        color: #333;
        margin-bottom: 20px;
    }

    .stats {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
        gap: 20px;
    }

    .stat-card {
        background-color: #ffffff;
        border-radius: 8px;
        padding: 20px;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        text-align: center;
        transition: transform 0.2s, box-shadow 0.2s;
    }

    .stat-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 6px 8px rgba(0, 0, 0, 0.15);
    }

    .stat-card h2 {
        font-size: 1.5rem;
        margin-bottom: 10px;
        color: #000000;
    }

    .stat-card p {
        font-size: 1.25rem;
        margin: 0;
        color: #555;
    }

    .stat-card i {
        font-size: 2.5rem;
        color: #000000;
        margin-bottom: 15px;
    }
</style>

<div class="dashboard-overview">
    <h1>Welcome to the Dashboard!</h1>
</div>

<div class="dashboard-overview">
    <h3>Food Ordering System</h3>

    <div class="stats">
        <!-- Categories Card -->
        <div class="stat-card">
            <i class="fas fa-list-alt"></i>
            <h2>Categories</h2>
            <p>{{ $totalCategories }} categories</p>
        </div>

        <!-- Products Card -->
        <div class="stat-card">
            <i class="fas fa-boxes"></i>
            <h2>Products</h2>
            <p>{{ $totalProducts }} items</p>
        </div>

        <!-- Inventory Card -->
        <div class="stat-card">
            <i class="fas fa-warehouse"></i>
            <h2>Inventory</h2>
            <p>{{ $totalInventory }} items in stock</p>
        </div>

    </div>
</div>

<div class="dashboard-overview">
    <h3>Customer Details</h3>

    <div class="stats">
        <!-- Customers Card -->
        <div class="stat-card">
            <i class="fas fa-users"></i>
            <h2>Customers</h2>
            <p>{{ $totalCustomers }} people</p>
        </div>

        <!-- Reservations Card -->
        <div class="stat-card">
            <i class="fas fa-calendar-check"></i>
            <h2>Reservations</h2>
            <p>{{ $totalReservations }} reservations</p>
        </div>

        <!-- Suppliers Card -->
        <div class="stat-card">
            <i class="fas fa-truck"></i>
            <h2>Suppliers</h2>
            <p>{{ $totalSuppliers }} suppliers</p>
        </div>

    </div>
</div>

@endsection
