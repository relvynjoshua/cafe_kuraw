@extends('layouts.dashboard')

@section('content')

@include('components.alert')

<style>
    /* Pagination container */
    .pagination {
        display: flex;
        justify-content: center;
        align-items: center;
        margin-top: 20px;
    }

    /* Pagination list */
    .pagination ul {
        list-style-type: none;
        padding: 0;
        margin: 0;
        display: flex;
    }

    /* Pagination items */
    .pagination li {
        margin: 0 5px;
    }

    /* Pagination links */
    .pagination a {
        display: inline-block;
        padding: 6px 12px;
        /* Adjusted padding for better button size */
        color: #007bff;
        text-decoration: none;
        border: 1px solid #ddd;
        border-radius: 3px;
        background-color: #fff;
        transition: background-color 0.3s, color 0.3s;
        font-size: 1rem;
        /* Adjusted font size for page numbers */
        line-height: 1.5;
    }

    /* Hover and active state */
    .pagination a:hover,
    .pagination .active a {
        background-color: #007bff;
        color: white;
    }

    /* Disabled state */
    .pagination .disabled a {
        color: #ccc;
        pointer-events: none;
    }

    /* Arrow buttons */
    .pagination .arrow {
        font-size: 1.2rem;
        /* Make the arrows a bit bigger */
        padding: 6px 10px;
    }

    /* Arrow hover effect */
    .pagination .arrow:hover {
        background-color: #007bff;
        color: white;
    }

    /* Adjust spacing and layout for responsiveness */
    @media (max-width: 768px) {
        .pagination .page-link {
            font-size: 10px;
            /* Smaller font size on smaller screens */
            padding: 3px 6px;
            /* Adjust padding for compact display */
        }
    }

    .container {
        background-color: #f9f9f9;
        padding: 20px;
        border-radius: 8px;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    }

    h1,
    h6 {
        color: #333;
    }
</style>

<div class="container mt-4" style="max-width: 100%; width: 90%;">

    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1>
            <i class="fas fa-warehouse"></i> Inventory Logs
        </h1>
        <div class="mt-3 mb-3 d-flex align-items-center">
            <!-- Dropdown for selecting timeframe -->
            <form action="" method="GET" id="exportForm">
                <div class="input-group">
                    <select name="timeframe" id="timeframe" class="form-control" onchange="updateExportUrl()">
                        <option value="" disabled selected>Select Time Frame</option>
                        <option value="daily">Daily</option>
                        <option value="monthly">Monthly</option>
                        <option value="yearly">Yearly</option>
                    </select>
                    <div class="input-group-append">
                        <button type="submit" class="btn btn-danger">
                            <i class="fas fa-file-pdf"></i> Export PDF
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- Search Bar -->
    <form action="{{ route('dashboard.logs.index') }}" method="GET" class="mb-4">
        <div class="input-group">
            <input type="text" name="search" value="{{ request('search') }}" class="form-control"
                placeholder="Search by ID, Inventory Item, Change Type, or Updated By">
            <div class="input-group-append">
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-search"></i> Search
                </button>
                <a href="{{ route('dashboard.logs.index') }}" class="btn btn-secondary ml-2">Reset</a>
            </div>
        </div>
    </form>

    <table class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>ID</th>
                <th>Inventory Item</th>
                <th>Change Type</th>
                <th>Quantity Changed</th>
                <th>Remaining Quantity</th>
                <th>Updated By</th>
                <th>Updated At</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($logs as $log)
                <tr>
                    <td>{{ $log->id }}</td>
                    <td>{{ $log->inventory ? $log->inventory->item_name : 'N/A' }}</td>
                    <td>{{ ucfirst($log->change_type) }}</td>
                    <td>{{ $log->quantity_changed }}</td>
                    <td>{{ $log->remaining_quantity }}</td>
                    <td>{{ $log->user ? $log->user->firstname : 'N/A' }}</td>
                    <td>{{ $log->updated_at->format('Y-m-d H:i:s') }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <!-- Pagination Links -->
    <div class="pagination">
        <!-- Previous arrow -->
        <a href="#" class="arrow" onclick="changePage('prev')">«</a>

        <!-- Page Numbers -->
        <span>Page {{ $logs->currentPage() }} of {{ $logs->lastPage() }}</span>

        <!-- Next arrow -->
        <a href="#" class="arrow" onclick="changePage('next')">»</a>
    </div>
</div>

<script>
    function updateExportUrl() {
        const timeframe = document.getElementById('timeframe').value;
        const form = document.getElementById('exportForm');
        form.action = `/dashboard/logs/export-pdf/${timeframe}`; // Set dynamic URL
    }
</script>

@endsection