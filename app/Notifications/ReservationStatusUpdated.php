<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class ReservationStatusUpdated extends Notification
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
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['mail', 'database']; // Sends via email and saves in the database
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
            ->subject('Reservation Status Updated')
            ->greeting('Hello ' . $notifiable->name . ',')
            ->line('Your reservation #' . $this->reservation->id . ' has been updated.')
            ->line('Status: ' . ucfirst($this->reservation->status))
            ->action('View Reservation', url('/reservations/' . $this->reservation->id))
            ->line('Thank you for using our service!');
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            'reservation_id' => $this->reservation->id,
            'customer_name' => $this->reservation->name,
            'email' => $this->reservation->email,
            'phone_number' => $this->reservation->phone_number,
            'reservation_date' => $this->reservation->reservation_date,
            'reservation_time' => $this->reservation->reservation_time,
            'number_of_guests' => $this->reservation->number_of_guests,
            'note' => $this->reservation->note,
            'status' => $this->reservation->status,
            'message' => "Your reservation #{$this->reservation->id} status is now {$this->reservation->status}.",
            'updated_at' => $this->reservation->updated_at->toDateTimeString(),
        ];
    }
}
