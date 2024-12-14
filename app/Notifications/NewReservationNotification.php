<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class NewReservationNotification extends Notification implements ShouldQueue
{
    use Queueable;

    public $reservation;

    /**
     * Create a new notification instance.
     */
    public function __construct($reservation)
    {
        $this->reservation = $reservation;
    }

    /**
     * Get the notification's delivery channels.
     */
    public function via($notifiable)
    {
        return ['database', 'mail', 'broadcast'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->subject('New Reservation Added')
            ->line("A new reservation has been added by {$this->reservation->name}.")
            ->line("Reservation Date: {$this->reservation->reservation_date}")
            ->line("Reservation Time: {$this->reservation->reservation_time}")
            ->line("Number of Guests: {$this->reservation->number_of_guests}")
            ->action('View Reservation', route('dashboard.reservations.index'));
    }

    public function toBroadcast($notifiable)
    {
        return new \Illuminate\Notifications\Messages\BroadcastMessage([
            'reservation_id' => $this->reservation->id,
            'customer_name' => $this->reservation->name,
            'reservation_date' => $this->reservation->reservation_date,
            'reservation_time' => $this->reservation->reservation_time,
            'number_of_guests' => $this->reservation->number_of_guests,
        ]);
    }

    /**
     * Get the array representation of the notification.
     */
    public function toArray($notifiable)
    {
        return [
            'reservation_id' => $this->reservation->id,
            'customer_name' => $this->reservation->name,
            'reservation_date' => $this->reservation->reservation_date,
            'reservation_time' => $this->reservation->reservation_time,
            'number_of_guests' => $this->reservation->number_of_guests,
        ];
    }
}
