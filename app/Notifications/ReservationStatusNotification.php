<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Messages\BroadcastMessage;
use Illuminate\Notifications\Notification;

class ReservationStatusNotification extends Notification
{
    use Queueable;

    protected $reservation;

    /**
     * Create a new notification instance.
     */
    public function __construct($reservation)
    {
        $this->reservation = $reservation;
    }

    /**
     * Determine the channels the notification will be sent through.
     */
    public function via($notifiable)
    {
        return ['mail', 'database']; // Email and database notification
    }

    /**
     * Define the mail representation of the notification.
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->subject('Reservation Status Update')
            ->greeting('Hello ' . $notifiable->firstname . ',')
            ->line('Your reservation #' . $this->reservation->id . ' has been updated.')
            ->line('Status: ' . ucfirst($this->reservation->status))
            ->action('View Reservation', url('/reservations/' . $this->reservation->id))
            ->line('Thank you for choosing us!');
    }

    /**
     * Define the database representation of the notification.
     */
    public function toArray($notifiable)
    {
        return [
            'reservation_id' => $this->reservation->id,
            'customer_name' => $this->reservation->name,
            'status' => $this->reservation->status,
            'message' => "Your reservation #{$this->reservation->reservation_id} is now {$this->reservation->status}.",
            'updated_at' => $this->reservation->updated_at->toDateTimeString(),
        ];
    }

    /**
     * Define the broadcast representation of the notification (optional).
     */
    public function toBroadcast($notifiable)
    {
        return new BroadcastMessage([
            'reservation_id' => $this->reservation->id,
            'status' => $this->reservation->status,
            'message' => "Your reservation #{$this->reservation->reservation_id} is now {$this->reservation->status}.",
        ]);
    }
}
