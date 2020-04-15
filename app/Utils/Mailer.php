<?php


namespace App\Utils;


class Mailer
{
    public function sendActivationEmail($email, $token)
    {
        return true;
    }

    public function sendWelcomePointsMail($email, $name, $lastname, $amount)
    {
        return true;
    }

}
