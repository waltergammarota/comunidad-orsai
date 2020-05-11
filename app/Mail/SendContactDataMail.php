<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SendContactDataMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($email, $subject, $mensaje, $name, $lastName)
    {
        $this->email = $email;
        $this->subject = $subject;
        $this->mensaje = $mensaje;
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
            "subject" => $this->subject,
            "mensaje" => $this->mensaje,
            "name" => $this->name,
            "lastName" => $this->lastName,
        ];
        return $this->subject('Info de contacto')->view(
            'mails.sendcontactdata-mail',
            $data
        );
    }
}
