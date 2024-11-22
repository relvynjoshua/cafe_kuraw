@extends('layouts.dashboard')

@section('content')

<h1>Inventory Item Details</h1>
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
    <!-- Add other fields if necessary -->
</table>
<a href="{{ route('inventory.index') }}" class="btn btn-secondary">Back to Inventory</a>
@endsection
