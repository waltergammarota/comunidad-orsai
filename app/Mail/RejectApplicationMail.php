<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class RejectApplicationMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($email, $comment)
    {
        $this->comment = $comment;
        $this->email = $email;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $data = [
            "email" => $this->email,
            "comment" => $this->comment,
        ];
        return $this->subject('Su postulación a Orsai fue rechazada')->view(
            'mails.reject-application',
            $data
        );
    }
}
