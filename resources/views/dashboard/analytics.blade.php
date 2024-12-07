@extends('layouts.dashboard')

@section('content')
<div class="container py-4">
    <h1>Sales Analytics</h1>

    <!-- Total Sales -->
    <div class="card mb-3">
        <div class="card-header">Total Sales</div>
        <div class="card-body">
            <h4>₱{{ number_format($totalSales, 2) }}</h4>
        </div>
    </div>

    <!-- Sales This Month -->
    <div class="card mb-3">
        <div class="card-header">Sales This Month</div>
        <div class="card-body">
            <h4>₱{{ number_format($salesThisMonth, 2) }}</h4>
        </div>
    </div>

    <!-- Daily Sales Chart -->
    <div class="card mb-3">
        <div class="card-header">Daily Sales (Last 7 Days)</div>
        <div class="card-body">
            <canvas id="dailySalesChart"></canvas>
        </div>
    </div>

    <!-- Top-Selling Products -->
    <div class="card mb-3">
        <div class="card-header">Top-Selling Products</div>
        <div class="card-body">
            <ul>
                @foreach ($topProducts as $product)
                    <li>{{ $product->name }} - {{ $product->total_quantity }} sold</li>
                @endforeach
            </ul>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    const dailySalesData = @json($dailySales);
    const ctx = document.getElementById('dailySalesChart').getContext('2d');

    const chartData = {
        labels: dailySalesData.map(data => data.date),
        datasets: [{
            label: 'Sales (₱)',
            data: dailySalesData.map(data => data.total),
            backgroundColor: 'rgba(75, 192, 192, 0.2)',
            borderColor: 'rgba(75, 192, 192, 1)',
            borderWidth: 1
        }]
    };

    new Chart(ctx, {
        type: 'line',
        data: chartData,
        options: {
            responsive: true,
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });
</script>
@endsection
