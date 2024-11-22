@extends('layouts.dashboard')

@section('content')
    <h1>Suppliers</h1>
    <a href="{{ route('dashboard.supplier.create') }}" class="btn btn-primary">Add Supplier</a>
    <table class="table">
        <thead>
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
            @foreach ($suppliers as $supplier)
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
            @endforeach 
        </tbody>
    </table>
@endsection