@extends('layouts.dashboard')

@section('title', 'Admin Dashboard')

@section('content')

<style>
    .dashboard-overview {
        background-color: #f9f9f9;
        padding: 20px;
        border-radius: 8px;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        margin-bottom: 20px;
        ;
    }

    .dashboard-overview h1 {
        font-size: 2rem;
        color: #333;
        margin-bottom: 20px;
    }

    .dashboard-overview h3 {
        font-size: 1.5rem;
        margin-bottom: 15px;
        text-align: center;
        color: #333;
    }

    .stats {
        display: flex;
        flex-wrap: wrap;
        justify-content: space-between;
        gap: 15px;
    }

    .stat-card {
        flex: 1 1 calc(33% - 10px); /* Three cards per row */
        padding: 15px;
        text-align: center;
        border: 1px solid #ddd;
        border-radius: 8px;
        background-color: #fff;
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        transition: transform 0.2s ease-in-out;
    }

    .stat-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
    }

    .stat-card i {
        font-size: 36px;
        color: #007bff;
        margin-bottom: 10px;
    }

    .stat-card h2 {
        font-size: 1.2rem;
        margin-bottom: 5px;
        color: #333;
    }

    .stat-card p {
        font-size: 1rem;
        color: #555;
    }

    @media (max-width: 768px) {
        .dashboard-overview {
            flex: 1 1 100%; /* Stacks horizontally on smaller screens */
        }

        .stat-card {
            flex: 1 1 calc(50% - 10px); /* Two cards per row */
        }
    }

    @media (max-width: 576px) {
        .stat-card {
            flex: 1 1 100%; /* Single column on very small screens */
        }
    }

    .clickable-card {
        transition: all 0.3s ease-in-out;
        cursor: pointer;
        border: 1px solid #dee2e6;
        border-radius: 0.5rem;
    }

    .clickable-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
    }

    .card-title {
        font-weight: bold;
        margin-bottom: 1rem;
    }

    .btn-outline-primary,
    .btn-outline-success {
        font-size: 14px;
        font-weight: 500;
        padding: 10px 20px;
        border-radius: 0.5rem;
    }

    .btn-outline-primary:hover,
    .btn-outline-success:hover {
        color: #fff;
    }

    .card {
        border-radius: 10px;
        transition: transform 0.2s ease;
    }

    .card:hover {
        transform: translateY(-5px);
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
    }

    .card-title {
        font-weight: bold;
        margin-bottom: 10px;
    }

    .card-text {
        font-size: 16px;
    }
</style>

<div class="dashboard-overview">
    <h1>Welcome to the Dashboard!</h1>
</div>

<div class="dashboard-overview">
    <h1>analytics here</h1>
    <h3>work in progress!!</h3>
    <h5>- suki/points rewards loyalty</h5>
    <h5>- statistics</h5>
    <h5>- overall sales?</h5>
</div>

<div class="dashboard-overview">
    <h1 class="mb-4 text-center">Dashboard Analytics</h1>
    
    <!-- Analytics Section -->
    <div class="row">
        <!-- Total Users -->
        <div class="col-md-4">
            <div class="card text-center shadow-sm mb-4">
                <div class="card-body">
                    <i class="fas fa-users fa-3x text-primary mb-3"></i>
                    <h5 class="card-title">Total Users</h5>
                    <p class="card-text display-6">{{ $totalCustomers ?? 0 }}</p>
                </div>
            </div>
        </div>
        
        <!-- Total Sales -->
        <div class="col-md-4">
            <div class="card text-center shadow-sm mb-4">
                <div class="card-body">
                    <i class="fas fa-coins fa-3x text-success mb-3"></i>
                    <h5 class="card-title">Total Sales</h5>
                    <p class="card-text display-6">₱{{ number_format($totalProducts ?? 0, 2) }}</p>
                </div>
            </div>
        </div>

        <!-- Total Orders -->
        <div class="col-md-4">
            <div class="card text-center shadow-sm mb-4">
                <div class="card-body">
                    <i class="fas fa-shopping-cart fa-3x text-warning mb-3"></i>
                    <h5 class="card-title">Total Orders</h5>
                    <p class="card-text display-6">{{ $totalOrders ?? 0 }}</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Loyalty Program Section -->
    <div class="card shadow-sm mb-4">
        <div class="card-body">
            <h5 class="card-title"><i class="fas fa-gift text-primary"></i> Suki/Points Loyalty Program</h5>
            <p class="card-text">Engage with customers through a rewards-based loyalty program. Customers earn points for their purchases, which can be redeemed for discounts or special offers.</p>
            <button class="btn btn-outline-primary">View Loyalty Program</button>
        </div>
    </div>

    <!-- Sales and Orders Chart -->
    <div class="card shadow-sm">
        <div class="card-body">
            <h5 class="card-title"><i class="fas fa-chart-line text-success"></i> Sales and Orders Overview</h5>
            <canvas id="salesOrdersChart"></canvas>
        </div>
    </div>
</div>

<div class="dashboard-overview">
    <h3 class="mb-4">Generate Reports</h3>

    <div class="row">
        <!-- Orders Reports -->
        <div class="col-md-6">
            <div class="card shadow-sm mb-4 clickable-card">
                <div class="card-body text-center">
                    <i class="fas fa-shopping-cart fa-2x text-primary mb-3"></i>
                    <h5 class="card-title">Orders Report</h5>
                    <div class="d-grid gap-2">
                        <a href="{{ route('dashboard.reports.orders', ['time_frame' => 'daily']) }}"
                            class="btn btn-outline-primary">
                            Daily Report
                        </a>
                        <a href="{{ route('dashboard.reports.orders', ['time_frame' => 'weekly']) }}"
                            class="btn btn-outline-primary">
                            Weekly Report
                        </a>
                        <a href="{{ route('dashboard.reports.orders', ['time_frame' => 'monthly']) }}"
                            class="btn btn-outline-primary">
                            Monthly Report
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Reservations Reports -->
        <div class="col-md-6">
            <div class="card shadow-sm mb-4 clickable-card">
                <div class="card-body text-center">
                    <i class="fas fa-calendar-alt fa-2x text-success mb-3"></i>
                    <h5 class="card-title">Reservations Report</h5>
                    <div class="d-grid gap-2">
                        <a href="{{ route('dashboard.reports.reservations', ['time_frame' => 'daily']) }}"
                            class="btn btn-outline-success">
                            Daily Report
                        </a>
                        <a href="{{ route('dashboard.reports.reservations', ['time_frame' => 'monthly']) }}"
                            class="btn btn-outline-success">
                            Monthly Report
                        </a>
                        <a href="{{ route('dashboard.reports.reservations', ['time_frame' => 'yearly']) }}"
                            class="btn btn-outline-success">
                            Yearly Report
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="dashboard-container">
    <!-- Food Ordering System Overview -->
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

    <!-- Customer Details Overview -->
    <div class="dashboard-overview">
        <h3>Customer Details</h3>
        <div class="stats">
            <!-- Customers Card -->
            <div class="stat-card">
                <i class="fas fa-users"></i>
                <h2>Customers</h2>
                <p>{{ $totalCustomers }} people</p>
            </div>
            <!-- Orders Card -->
            <div class="stat-card">
                <i class="fas fa-shopping-cart"></i>
                <h2>Orders</h2>
                <p>{{ $totalOrders }} orders</p>
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
</div>

<!-- Include Chart.js -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    const ctx = document.getElementById('salesOrdersChart').getContext('2d');
    const salesOrdersChart = new Chart(ctx, {
        type: 'line',
        data: {
            labels: @json($chartLabels ?? ['January', 'February', 'March']), // Dynamic months or periods
            datasets: [
                {
                    label: 'Total Sales',
                    data: @json($salesData ?? [10000, 15000, 20000]), // Example data
                    borderColor: 'rgba(75, 192, 192, 1)',
                    backgroundColor: 'rgba(75, 192, 192, 0.2)',
                    fill: true,
                    tension: 0.4
                },
                {
                    label: 'Total Orders',
                    data: @json($ordersData ?? [50, 75, 100]), // Example data
                    borderColor: 'rgba(255, 206, 86, 1)',
                    backgroundColor: 'rgba(255, 206, 86, 0.2)',
                    fill: true,
                    tension: 0.4
                }
            ]
        },
        options: {
            responsive: true,
            plugins: {
                legend: {
                    position: 'top',
                },
                tooltip: {
                    mode: 'index',
                    intersect: false
                }
            },
            interaction: {
                mode: 'nearest',
                axis: 'x',
                intersect: false
            },
            scales: {
                x: {
                    title: {
                        display: true,
                        text: 'Months'
                    }
                },
                y: {
                    title: {
                        display: true,
                        text: 'Values'
                    },
                    beginAtZero: true
                }
            }
        }
    });
</script>

@endsection