<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ResetPasswordMail extends Mailable
{
    use Queueable, SerializesModels;

    public $resetLink;

    /**
     * Create a new message instance.
     */
    public function __construct($resetLink)
    {
        $this->resetLink = $resetLink;
    }

    /**
     * Build the message.
     */
    public function build()
    {
        return $this->subject('Password Reset Request')
                    ->view('emails.reset-password') // Blade template for email
                    ->with(['resetLink' => $this->resetLink]);
    }
}
