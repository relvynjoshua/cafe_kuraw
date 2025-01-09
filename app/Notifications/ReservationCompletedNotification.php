<?php

namespace App\Notifications;

use App\Models\Reservation;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class ReservationCompletedNotification extends Notification
{
    use Queueable;

    protected $reservation;

    /**
     * Create a new notification instance.
     */
    public function __construct(Reservation $reservation)
    {
        $this->reservation = $reservation;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via($notifiable)
    {
        return ['mail', 'database']; // Send via mail and store in the database
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->subject('Reservation Completed')
            ->greeting('Hello ' . $notifiable->name . ',')
            ->line("Your reservation #{$this->reservation->id} has been completed successfully.")
            ->line("Reservation Date: " . $this->reservation->date->format('F j, Y'))
            ->line("Thank you for choosing our service!")
            ->action('View Reservation', url('/reservations/' . $this->reservation->id));
    }

    /**
     * Get the database representation of the notification.
     */
    public function toArray($notifiable)
    {
        return [
            'reservation_id' => $this->reservation->id,
            'customer_name' => $this->reservation->customer_name,
            'reservation_date' => $this->reservation->date->toDateTimeString(),
            'message' => "Your reservation #{$this->reservation->id} has been completed successfully.",
        ];
    }
}
