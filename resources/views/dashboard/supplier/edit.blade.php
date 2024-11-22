@extends('layouts.dashboard')

@section('content')
    <h1>Edit Supplier</h1>
    <form action="{{ route('dashboard.supplier.update', $supplier) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="company_name">Company Name</label>
            <input type="text" name="company_name" class="form-control" id="company_name" value="{{ $supplier->company_name ?? '' }}" required>
        </div>
        <div class="form-group">
            <label for="contact_person">Contact Person</label>
            <input type="text" name="contact_person" class="form-control" id="contact_person" value="{{ $supplier->contact_person ?? '' }}" required>
        </div>
        <div class="form-group">
            <label for="phone_number">Phone Number</label>
            <input type="text" name="phone_number" class="form-control" id="phone_number" value="{{ $supplier->phone_number ?? '' }}" required>
        </div>
        <div class="form-group">
            <label for="email">Company Email</label>
            <input type="email" name="email" class="form-control" id="email" value="{{ $supplier->email ?? '' }}" required>
        </div>
        <div class="form-group">
            <label for="address">Company Address</label>
            <input type="text" name="address" class="form-control" id="address" value="{{ $supplier->address ?? '' }}" required>
        </div>
        <button type="submit" class="btn btn-primary">Update Supplier</button>
    </form>
@endsection
