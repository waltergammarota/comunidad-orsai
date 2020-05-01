<?php


namespace App\Utils;


use App\Jobs\ProcessActivationMail;
use App\Jobs\ProcessApproveMail;
use App\Jobs\ProcessRejectMail;
use App\Jobs\ProcessResetPasswordMail;
use App\Jobs\ProcessWelcomePointsMail;
use App\Mail\ApproveApplicationMail;
use Illuminate\Support\Facades\Mail;

class Mailer
{
    public function sendActivationEmail($email, $name, $lastname, $token)
    {
        ProcessActivationMail::dispatch($email, $name, $lastname, $token);
        return true;
    }

    public function sendWelcomePointsMail($email, $name, $lastname, $amount)
    {
        ProcessWelcomePointsMail::dispatch($email, $name, $lastname, $amount);
        return true;
    }

    public function sendResetPasswordMail($email, $token)
    {
        ProcessResetPasswordMail::dispatch($email, $token);
        return true;
    }

    public function sendRejectEmail($email, $comment)
    {
        ProcessRejectMail::dispatch($email, $comment);
        return true;
    }

    public function sendApproveMail($email)
    {
        ProcessApproveMail::dispatch($email);
        return true;
    }

}
