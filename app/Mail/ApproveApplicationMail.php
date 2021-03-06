<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ApproveApplicationMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($email, $cpaId)
    {
        $this->email = $email;
        $this->cpaId = $cpaId;
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
            "cpaId" => $this->cpaId
        ];
        return $this->subject('Ya estás participando del concurso')->view(
            'mails.approved-application',
            $data
        );
    }
}
