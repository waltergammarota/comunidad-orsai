<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SendEmailToAdministrator extends Mailable
{
    use Queueable, SerializesModels;

    protected $email;
    protected $cpaId;
    protected $name;
    protected $lastName;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($email, $cpaId, $name, $lastName)
    {
        $this->email = $email;
        $this->cpaId = $cpaId;
        $this->name = $name;
        $this->lastName = $lastName;
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
            "cpaId" => $this->cpaId,
            "name" => $this->name,
            "lastName" => $this->lastName
        ];
        return $this->subject('Hay una nueva propuesta')->view(
            'mails.mail-administrator',
            $data
        );
    }
}
