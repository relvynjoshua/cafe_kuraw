@extends('layouts.app') <!-- Adjust this to your layout file -->

@section('title', 'Notifications')

@section('content')
<div class="container mt-5">
    <h1 class="mb-4">Notifications</h1>
    
    @if($notifications->isEmpty())
        <div class="alert alert-info">You have no notifications.</div>
    @else
        <div class="list-group">
            @foreach($notifications as $notification)
                <div class="list-group-item d-flex justify-content-between align-items-center">
                    <div>
                        <p class="mb-1">{{ $notification->data['message'] ?? 'Notification details unavailable' }}</p>
                        <small class="text-muted">{{ $notification->created_at->diffForHumans() }}</small>
                    </div>
                    @if($notification->read_at)
                        <span class="badge bg-success">Read</span>
                    @else
                        <span class="badge bg-danger">Unread</span>
                    @endif
                </div>
            @endforeach
        </div>
    @endif
</div>
@endsection
