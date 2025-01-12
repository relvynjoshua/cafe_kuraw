<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class NewOrderPlaced extends Notification
{
    use Queueable;

    public $order;

    /**
     * Create a new notification instance.
     */
    public function __construct($order)
    {
        $this->order = $order;
    }

    /**
     * Get the notification's delivery channels.
     */
    public function via($notifiable)
    {
        return ['mail', 'database', 'broadcast'];
    }

    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->subject('New Order Placed')
            ->line("A new order (#{$this->order->id}) has been placed by {$this->order->customer_name}.")
            ->line("Total Amount: ₱" . number_format($this->order->total_amount, 2))
            ->action('View Order', route('dashboard.orders.show', $this->order->id));
    }

    public function toBroadcast($notifiable)
    {
        return new \Illuminate\Notifications\Messages\BroadcastMessage([
            'order_id' => $this->order->id,
            'customer_name' => $this->order->customer_name,
            'total_amount' => $this->order->total_amount,
            'message' => "New order placed by {$this->order->customer_name}, total: ₱" . number_format($this->order->total_amount, 2),
        ]);
    }

    /**
     * Get the array representation of the notification.
     */
    public function toArray($notifiable)
    {
        return [
            'order_id' => $this->order->id,
            'customer_name' => $this->order->customer_name,
            'total_amount' => $this->order->total_amount,
            'message' => "New order placed by {$this->order->customer_name}, total: ₱" . number_format($this->order->total_amount, 2),
        ];
    }

    public function toDatabase($notifiable)
    {
        return [
            'order_id' => $this->order->id,
            'customer_name' => $this->order->customer_name,
            'email' => $this->order->email,
            'status' => $this->order->status,
            'total_amount' => $this->order->total_amount,
            'message' => "New order placed by {$this->order->customer_name}, total: ₱" . number_format($this->order->total_amount, 2),
        ];
    }
}
