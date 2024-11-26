@extends('layouts.dashboard')

@section('content')

@include('components.alert')

<div class="d-flex justify-content-between align-items-center mb-4">
    <h1>Supplier List</h1>
    <a href="{{ route('dashboard.supplier.create') }}" class="btn btn-primary">Add Supplier</a>
</div>

<div class="card shadow">
    <div class="card-body">
        <table class="table table-striped">
            <thead class="thead-dark">
                <tr>
                    <th>ID</th>
                    <th>Company Name</th>
                    <th>Contact Person</th>
                    <th>Phone Number</th>
                    <th>Email</th>
                    <th>Address</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($suppliers as $supplier)
                    <tr>
                        <td>{{ $supplier->id }}</td>
                        <td>{{ $supplier->company_name }}</td>
                        <td>{{ $supplier->contact_person }}</td>
                        <td>{{ $supplier->phone_number }}</td>
                        <td>{{ $supplier->email }}</td>
                        <td>{{ $supplier->address }}</td>
                        <td>
                            <a href="{{ route('dashboard.supplier.edit', $supplier) }}" class="btn btn-sm btn-warning">Edit</a>
                            <form action="{{ route('dashboard.supplier.destroy', $supplier) }}" method="POST" style="display: inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="text-center">No suppliers found.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

@endsection
