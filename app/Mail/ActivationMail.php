<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ActivationMail extends Mailable
{
    use Queueable, SerializesModels;

    private $name;
    private $lastname;
    private $token;


    public function __construct($name,$lastname, $token)
    {
        $this->name = $name;
        $this->lastname = $lastname;
        $this->token = $token;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $data = ["name" => $this->name, "lastname" => $this->lastname, "token" => $this->token];
        return $this->subject('Activación de cuenta')->view('mails.activation-mail', $data);
    }
}
