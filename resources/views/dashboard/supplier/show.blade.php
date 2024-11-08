@extends('layouts.dashboard')

@section('content')
    <h1>Supplier Details</h1>    
    <table class="table">
        <tr>
            <th>ID</th>
            <td>{{ $supplier->id }}</td>
        </tr>
        <tr>
            <th>Name</th>
            <td>{{ $supplier->name }}</td>
        </tr>
        <tr>
            <th>Email</th>
            <td>{{ $supplier->email }}</td>
        </tr>
        <tr>
            <th>Phone</th>
            <td>{{ $supplier->phone }}</td>
        </tr>
    </table>
    <a href="{{ route('suppliers.index') }}" class="btn btn-secondary">Back to Suppliers</a>
@endsection
