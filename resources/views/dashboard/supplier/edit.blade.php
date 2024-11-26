@extends('layouts.dashboard')

@section('content')

@include('components.alert')

<a href="{{ route('dashboard.supplier.index') }}" class="btn btn-secondary mb-3">Back to Suppliers</a>

<div class="card shadow p-4">
    <h2 class="mb-4">Edit Supplier</h2>
    <form action="{{ route('dashboard.supplier.update', $supplier) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="form-group mb-3">
            <label for="company_name" class="form-label">Company Name</label>
            <input type="text" name="company_name" class="form-control" id="company_name" value="{{ $supplier->company_name }}" required>
        </div>

        <div class="form-group mb-3">
            <label for="contact_person" class="form-label">Contact Person</label>
            <input type="text" name="contact_person" class="form-control" id="contact_person" value="{{ $supplier->contact_person }}" required>
        </div>

        <div class="form-group mb-3">
            <label for="phone_number" class="form-label">Phone Number</label>
            <input type="text" name="phone_number" class="form-control" id="phone_number" value="{{ $supplier->phone_number }}" required>
        </div>

        <div class="form-group mb-3">
            <label for="email" class="form-label">Company Email</label>
            <input type="email" name="email" class="form-control" id="email" value="{{ $supplier->email }}" required>
        </div>

        <div class="form-group mb-3">
            <label for="address" class="form-label">Company Address</label>
            <input type="text" name="address" class="form-control" id="address" value="{{ $supplier->address }}" required>
        </div>

        <button type="submit" class="btn btn-primary">Update Supplier</button>
    </form>
</div>

@endsection
