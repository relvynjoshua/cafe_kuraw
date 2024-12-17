@extends('layouts.app')

@section('title', 'Edit Profile')

@section('content')
<!-- Profile CSS -->
<link rel="stylesheet" href="{{ asset('assets/css/profile.css') }}">

<div class="container py-5">
    <div class="row">
        <div class="col-lg-9 mx-auto">
            <div class="card shadow">
                <div class="card-header bg-success text-white d-flex align-items-center">
                    <i class="fas fa-edit fa-lg me-3"></i>
                    <h3 class="mb-0 me-2">Edit Profile</h3>
                </div>
                <div class="card-body">
                    <form action="{{ route('profile.update') }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="mb-2">
                            <label for="firstname" class="form-label">Name</label>
                            <input type="text" name="firstname" id="firstname" class="form-control"
                                value="{{ $user->firstname }}" required>
                        </div>
                        <div class="mb-2">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" name="email" id="email" class="form-control" value="{{ $user->email }}"
                                required>
                        </div>
                        <div class="mb-2">
                            <label for="current_password" class="form-label">Current Password <small
                                    class="text-muted">(Required to change password)</small></label>
                            <input type="password" name="current_password" id="current_password" class="form-control">
                        </div>
                        <div class="mb-2">
                            <label for="password" class="form-label">New Password <small class="text-muted">(Leave blank
                                    to keep current password)</small></label>
                            <input type="password" name="password" id="password" class="form-control">
                        </div>
                        <div class="mb-2">
                            <label for="password_confirmation" class="form-label">Confirm New Password</label>
                            <input type="password" name="password_confirmation" id="password_confirmation"
                                class="form-control">
                        </div>
                        <button type="submit" class="btn bg-success w-100">Save Changes</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection