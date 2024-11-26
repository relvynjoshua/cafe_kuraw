@extends('layouts.dashboard')

@section('content')

@include('components.alert')

<div class="d-flex justify-content-between align-items-center mb-4">
    <h1>Inventory List</h1>
    <a href="{{ route('dashboard.inventory.create') }}" class="btn btn-primary">Add Inventory Item</a>
</div>

<div class="card shadow">
    <div class="card-body">
        <table class="table table-striped">
            <thead class="thead-dark">
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Item Name</th>
                    <th scope="col">Quantity</th>
                    <th scope="col">Unit</th>
                    <th scope="col">Price</th>
                    <th scope="col">Category</th>
                    <th scope="col">Supplier</th>
                    <th scope="col">Location</th>
                    <th scope="col">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($inventories as $inventory)
                    <tr>
                        <td>{{ $inventory->id }}</td>
                        <td>{{ $inventory->item_name }}</td>
                        <td>{{ $inventory->quantity }}</td>
                        <td>{{ $inventory->unit }}</td>
                        <td>{{ $inventory->price }}</td>
                        <td>{{ $inventory->category->name ?? 'N/A' }}</td>
                        <td>{{ $inventory->supplier->company_name ?? 'N/A' }}</td>
                        <td>{{ $inventory->location ?? 'N/A' }}</td>
                        <td>
                            <a href="{{ route('dashboard.inventory.edit', $inventory->id) }}" class="btn btn-warning btn-sm">Edit</a>
                            <form action="{{ route('dashboard.inventory.destroy', $inventory->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="9" class="text-center">No inventory items found.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

@endsection
