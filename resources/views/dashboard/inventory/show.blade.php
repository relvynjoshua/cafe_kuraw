@extends('layouts.dashboard')

@section('content')

<style>
    h1 {
        font-size: 24px;
        color: #333;
        margin-bottom: 20px;
    }

    .table th,
    .table td {
        padding: 10px;
    }

    .table th {
        background-color: #f8f9fa;
    }

    .table tr:nth-child(even) {
        background-color: #f2f2f2;
    }

    .table tr:hover {
        background-color: #e9ecef;
    }

    .btn.btn-secondary {
        margin-top: 20px;
        padding: 10px 15px;
    }

    .table-responsive {
        overflow-x: auto;
    }
</style>

<h1>Inventory Item Details</h1>
<div class="table-responsive">
    <table class="table">
        <tr>
            <th>ID</th>
            <td>{{ $inventory->id }}</td>
        </tr>
        <tr>
            <th>Item Name</th>
            <td>{{ $inventory->item_name }}</td>
        </tr>
        <tr>
            <th>Quantity</th>
            <td>{{ $inventory->quantity }}</td>
        </tr>
        <tr>
            <th>Unit</th>
            <td>{{ $inventory->unit }}</td>
        </tr>
        <tr>
            <th>Price</th>
            <td>{{ $inventory->price }}</td>
        </tr>
        <tr>
            <th>Supplier</th>
            <td>{{ $inventory->supplier->company_name ?? 'N/A' }}</td>
        </tr>
        <tr>
            <th>Category</th>
            <td>{{ $inventory->category->name ?? 'N/A' }}</td>
        </tr>
        <tr>
            <th>Location</th>
            <td>{{ $inventory->location ?? 'N/A' }}</td>
        </tr>
        <tr>
            <th>Description</th>
            <td>{{ $inventory->description ?? 'No description available' }}</td>
        </tr>
    </table>
</div>

<a href="{{ route('inventory.index') }}" class="btn btn-secondary">Back to Inventory</a>

@endsection