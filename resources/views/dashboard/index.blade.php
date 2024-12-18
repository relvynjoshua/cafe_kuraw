@extends('layouts.dashboard')

@section('title', 'Admin Dashboard')

@section('content')

<!-- Dashboard Styles -->
<style>
    .dashboard-title {
        text-align: center;
        font-size: 2.5rem;
        font-weight: bold;
        margin: 20px 0;
        color: #222;
    }

    /* Grid Layout */
    .dashboard-container {
        display: grid;
        grid-template-columns: 1fr 2fr;
        gap: 20px;
    }

    /* Left Section */
    .left-section {
        display: flex;
        flex-direction: column;
        gap: 20px;
    }

    .kpi-container {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 15px;
    }

    .kpi-card {
        background-color: #ffffff;
        border: 1px solid #ddd;
        border-radius: 10px;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        text-align: center;
        padding: 20px;
        transition: transform 0.3s ease-in-out;
    }

    .kpi-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 6px 10px rgba(0, 0, 0, 0.2);
    }

    .kpi-icon {
        font-size: 2.5rem;
        margin-bottom: 10px;
        color: #000;
        /* Changed to black */
    }

    .kpi-value {
        font-size: 2rem;
        font-weight: bold;
    }

    .kpi-title {
        color: #555;
    }

    .table-card {
        background-color: #ffffff;
        border-radius: 10px;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        padding: 15px;
    }

    table {
        width: 100%;
        border-collapse: collapse;
    }

    table th,
    table td {
        text-align: center;
        padding: 10px;
        border-bottom: 1px solid #ddd;
    }

    table th {
        background-color: #000;
        /* Black color */
        color: #fff;
    }

    /* Right Section */
    .right-section {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 20px;
    }

    .chart-card {
        background-color: #ffffff;
        border-radius: 10px;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        padding: 15px;
        text-align: center;
    }

    .chart-title {
        font-weight: bold;
        margin-bottom: 10px;
        color: #222;
    }

    /* Generate Reports */
    .report-container {
        margin-top: 20px;
        text-align: center;
        background-color: #000;
        /* Black */
        padding: 20px;
        border-radius: 10px;
        color: #fff;
    }

    .btn-report {
        padding: 10px 20px;
        margin: 5px;
        font-size: 1rem;
        border: none;
        border-radius: 5px;
        background-color: #333;
        /* Dark black-gray */
        color: #fff;
        transition: 0.3s;
    }

    .btn-report:hover {
        background-color: #000;
    }

    /* Responsive */
    @media (max-width: 992px) {
        .dashboard-container {
            grid-template-columns: 1fr;
        }

        .right-section {
            grid-template-columns: 1fr;
        }
    }
</style>

<div class="container mt-4" style="max-width: 100%; width: 95%;">
    <!-- Dashboard Title -->
    <div class="dashboard-title">Admin Dashboard</div>

    <!-- Dashboard Grid -->
    <div class="dashboard-container">
        <!-- Left Section -->
        <div class="left-section">
            <!-- KPI Cards -->
            <div class="kpi-container">
                <div class="kpi-card">
                    <i class="fas fa-dollar-sign kpi-icon"></i>
                    <div class="kpi-value">₱{{ number_format($salesData ?? 150000, 2) }}</div>
                    <div class="kpi-title">Overall Sales</div>
                </div>
                <div class="kpi-card">
                    <i class="fas fa-shopping-cart kpi-icon"></i>
                    <div class="kpi-value">{{ $totalOrders ?? 340 }}</div>
                    <div class="kpi-title">Total Orders</div>
                </div>
                <div class="kpi-card">
                    <i class="fas fa-users kpi-icon"></i>
                    <div class="kpi-value">{{ $totalUsers ?? 150 }}</div>
                    <div class="kpi-title">Total Users</div>
                </div>
            </div>

            <!-- Incoming Orders -->
            <div class="table-card">
                <h4>Incoming Orders</h4>
                <table>
                    <tr>
                        <th>Name</th>
                        <th>Order Count</th>
                        <th>Last Order</th>
                    </tr>
                    <tr>
                        <td>John Doe</td>
                        <td>5</td>
                        <td>2024-01-15</td>
                    </tr>
                    <tr>
                        <td>Jane Smith</td>
                        <td>8</td>
                        <td>2024-01-14</td>
                    </tr>
                </table>
            </div>

            <!-- Incoming Reservations -->
            <div class="table-card">
                <h4>Incoming Reservations</h4>
                <table>
                    <tr>
                        <th>Name</th>
                        <th>Reservation Count</th>
                        <th>Last Reservation</th>
                    </tr>
                    <tr>
                        <td>Sarah Brown</td>
                        <td>3</td>
                        <td>2024-01-12</td>
                    </tr>
                    <tr>
                        <td>Mark Lee</td>
                        <td>4</td>
                        <td>2024-01-10</td>
                    </tr>
                </table>
            </div>
        </div>

        <!-- Right Section -->
        <div class="right-section">
            <div class="chart-card">
                <div class="chart-title">Orders by Time</div>
                <div id="ordersByTimeChart"></div>
            </div>
            <div class="chart-card">
                <div class="chart-title">Inventory Overview</div>
                <div id="inventoryChart"></div>
            </div>
            <div class="chart-card">
                <div class="chart-title">Reward System</div>
                <div id="rewardSystemChart"></div>
            </div>
            <div class="chart-card">
                <div class="chart-title">Customer Growth</div>
                <div id="customerGrowthChart"></div>
            </div>
        </div>
    </div>

    <!-- Generate Reports -->
    <div class="report-container">
        <h3>Generate Reports</h3>
        <button class="btn-report">Daily Orders</button>
        <button class="btn-report">Weekly Orders</button>
        <button class="btn-report">Monthly Orders</button>
        <button class="btn-report">Daily Reservations</button>
        <button class="btn-report">Weekly Reservations</button>
        <button class="btn-report">Monthly Reservations</button>
    </div>
</div>


<!-- Include ApexCharts -->
<script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
<script>
    // Orders by Time
    new ApexCharts(document.querySelector("#ordersByTimeChart"), {
        series: [{ name: "Orders", data: [120, 150, 180] }],
        chart: { type: "bar", height: 300 },
        xaxis: { categories: ["Daily", "Weekly", "Monthly"] },
        colors: ["#000"]
    }).render();

    // Inventory Overview
    new ApexCharts(document.querySelector("#inventoryChart"), {
        series: [40, 30, 30],
        chart: { type: "pie", height: 300 },
        labels: ["Available", "Sold", "Reserved"],
        colors: ["#000", "#555", "#888"]
    }).render();

    // Customer Growth
    new ApexCharts(document.querySelector("#customerGrowthChart"), {
        series: [{ name: "Growth", data: [10, 20, 30, 40] }],
        chart: { type: "area", height: 300 },
        colors: ["#000"]
    }).render();

    // Reward System
    new ApexCharts(document.querySelector("#rewardSystemChart"), {
        series: [40, 35, 25],
        chart: { type: "donut", height: 300 },
        labels: ["Earned", "Used", "Expired"],
        colors: ["#000", "#555", "#888"]
    }).render();
</script>

@endsection