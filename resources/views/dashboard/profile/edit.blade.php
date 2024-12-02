@extends('layouts.dashboard')

@section('content')

@include('components.alert')

<div class="container">
    <a href="{{ route('dashboard.profile.index') }}" class="btn btn-secondary mb-3">Back to Profiles</a>

    <div class="card shadow">
        <div class="card-body">
            <h2 class="mb-4">Edit Profile</h2>
            <form action="{{ route('dashboard.profile.update', $user->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="form-group mb-3">
                    <label for="firstname" class="form-label">Name</label>
                    <input type="text" name="firstname" class="form-control" id="firstname" value="{{ $user->firstname }}" required>
                    @error('firstname')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" name="email" class="form-control" id="email" value="{{ $user->email }}" required>
                    @error('email')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group mb-3">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" name="password" class="form-control" id="password" placeholder="Leave blank to keep current password">
                    @error('password')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <button type="submit" class="btn btn-primary">Update Profile</button>
            </form>
        </div>
    </div>
</div>

@endsection
