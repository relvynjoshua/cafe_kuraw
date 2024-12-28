<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order; // Import Order model to validate orderId
use Illuminate\Support\Facades\Auth;

class NotificationController extends Controller
{
    // Fetch unread notifications for the logged-in user
    public function getNotifications(Request $request)
    {
        $user = Auth::user();

        // Fetch unread notifications for the user
        $notifications = $user->unreadNotifications;

        // Return the notifications in JSON format for the frontend (use pagination if necessary)
        return response()->json([
            'status' => 'success',
            'notifications' => $notifications
        ]);
    }

    // Mark a specific notification as read for a given order
    public function markRead($notificationId)
    {
        $notification = Auth::user()->unreadNotifications()->find($notificationId);

        if ($notification) {
            $notification->markAsRead();
            return response()->json([
                'status' => 'success',
                'message' => 'Notification marked as read.',
            ]);
        }

        return response()->json([
            'status' => 'error',
            'message' => 'Notification not found.',
        ], 404);
    }

    // Mark all notifications as read for the authenticated user
    public function markAllRead()
    {
        $user = Auth::user();
        
        // Fetch unread notifications
        $unreadNotifications = $user->unreadNotifications;
        
        // If there are no unread notifications
        if ($unreadNotifications->isEmpty()) {
            return response()->json([
                'status' => 'success',
                'message' => 'No unread notifications to mark as read.',
                'notification_count' => 0,
            ]);
        }
        
        // Mark all unread notifications as read
        $unreadNotifications->markAsRead();
        
        return response()->json([
            'status' => 'success',
            'message' => 'All notifications marked as read.',
            'notification_count' => auth()->user()->unreadNotifications()->count(),  // Return updated count
        ]);
    }
}
