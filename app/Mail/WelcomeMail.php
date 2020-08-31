<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class WelcomeMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($email, $name, $lastname, $amount, $url)
    {
        $this->name = $name;
        $this->email = $email;
        $this->lastname = $lastname;
        $this->url = $url;
        $this->amount = $amount;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $data = [
            "name" => $this->name,
            "email" => $this->email,
            "lastname" => $this->lastname,
            "amount" => $this->amount,
            "url" => $this->url
        ]; 
        return $this->subject('Bienvenido ' . $data['name'] . ' a Comunidad Orsai')->view(
            'mails.puntos-bienvenida',
            $data
        );
    }
}
