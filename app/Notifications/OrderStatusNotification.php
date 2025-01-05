<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Messages\BroadcastMessage;
use Illuminate\Notifications\Notification;

class OrderStatusNotification extends Notification
{
    use Queueable;

    protected $order;

    /**
     * Create a new notification instance.
     */
    public function __construct($order)
    {
        $this->order = $order;
    }

    /**
     * Determine which channels the notification should use.
     */
    public function via($notifiable)
    {
        return ['mail', 'database']; // Sends via email and saves in the database
    }

    /**
     * Define the mail representation of the notification.
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->subject('Order Status Update')
            ->greeting('Hello ' . $notifiable->firstname . ',')
            ->line('Your order #' . $this->order->id . ' status has been updated.')
            ->line('Status: ' . ucfirst($this->order->status))
            ->action('View Order', url('/orders/' . $this->order->id))
            ->line('Thank you for ordering!');
    }

    /**
     * Define the database representation of the notification.
     */
    public function toArray($notifiable)
    {
        return [
            'order_id' => $this->order->id,
            'customer_name' => $this->order->customer_name,
            'status' => $this->order->status,
            'message' => "Your order #{$this->order->id} is now {$this->order->status}.",  
            'updated_at' => $this->order->updated_at->toDateTimeString(),
        ];
    }

    public function toBroadcast($notifiable)
    {
        return new BroadcastMessage([
            'order_id' => $this->order->id,
            'status' => $this->order->status,
            'message' => "Your order #{$this->order->id} is now {$this->order->status}.",
        ]);
    }
}
