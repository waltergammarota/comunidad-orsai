<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SendReminderActivationEmail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($email, $subject, $mensaje, $name, $lastName, $token)
    {
        $this->email = $email;
        $this->subject = $subject;
        $this->mensaje = $mensaje;
        $this->name = $name;
        $this->lastName = $lastName;
        $this->token = $token;
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
            "token" => $this->token,
        ];
        return $this->subject($this->subject)->view(
            'mails.reminderActivation-mail',
            $data
        );
    }
}
