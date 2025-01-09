@extends('layouts.dashboard')

@section('content')

@include('components.alert')
<style>
    /* Solid border */
    hr.solid {
        border-top: 5px solid #000000;
    }
</style>

<a href="{{ route('dashboard.supplier.index') }}" class="btn btn-secondary mb-3">Back to Suppliers</a>

<div class="card shadow p-4">
    <h2 class="mb-4">Edit Supplier</h2>
    <hr class="solid">

    <form action="{{ route('dashboard.supplier.update', $supplier) }}" method="POST">
        @csrf
        @method('PUT')

        <!-- Company Name -->
        <div class="form-group mb-3">
            <label for="company_name" class="form-label fw-bold">Company Name</label>
            <input 
                type="text" 
                name="company_name" 
                class="form-control @error('company_name') is-invalid @enderror" 
                id="company_name" 
                value="{{ old('company_name', $supplier->company_name) }}" 
                placeholder="Enter company name" 
                required>
            @error('company_name')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <!-- Contact Person -->
        <!-- <div class="form-group mb-3">
            <label for="contact_person" class="form-label fw-bold">Contact Person</label>
            <input 
                type="text" 
                name="contact_person" 
                class="form-control @error('contact_person') is-invalid @enderror" 
                id="contact_person" 
                value="{{ old('contact_person', $supplier->contact_person) }}" 
                placeholder="Enter contact person's name" 
                required>
            @error('contact_person')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div> -->

        <!-- Phone Number -->
        <!-- <div class="form-group mb-3">
            <label for="phone_number" class="form-label fw-bold">Phone Number</label>
            <input 
                type="text" 
                name="phone_number" 
                class="form-control @error('phone_number') is-invalid @enderror" 
                id="phone_number" 
                value="{{ old('phone_number', $supplier->phone_number) }}" 
                placeholder="Enter phone number" 
                required>
            @error('phone_number')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div> -->

        <!-- Email -->
        <!-- <div class="form-group mb-3">
            <label for="email" class="form-label fw-bold">Company Email</label>
            <input 
                type="email" 
                name="email" 
                class="form-control @error('email') is-invalid @enderror" 
                id="email" 
                value="{{ old('email', $supplier->email) }}" 
                placeholder="Enter company email" 
                required>
            @error('email')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div> -->

        <!-- Address -->
        <div class="form-group mb-3">
            <label for="address" class="form-label fw-bold">Company Address</label>
            <textarea 
                name="address" 
                class="form-control @error('address') is-invalid @enderror" 
                id="address" 
                placeholder="Enter company address" 
                rows="3" 
                required>{{ old('address', $supplier->address) }}</textarea>
            @error('address')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <!-- Submit Button -->
        <button type="submit" class="btn btn-primary">Update Supplier</button>
    </form>
</div>

@endsection
