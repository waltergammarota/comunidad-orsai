<?php


namespace App\Utils;


use App\Jobs\ProcessActivationMail;
use App\Jobs\ProcessApproveMail;
use App\Jobs\ProcessRejectMail;
use App\Jobs\ProcessResetPasswordMail;
use App\Jobs\ProcessSendContactData;
use App\Jobs\ProcessSendMailToAdministrator;
use App\Jobs\ProcessSendReminderActivationEmail;
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

    public function sendApproveMail($email, $cpaId)
    {
        ProcessApproveMail::dispatch($email, $cpaId);
        return true;
    }

    public function sendMailToAdministrator($email, $cpaId, $name, $lastName) {
        ProcessSendMailToAdministrator::dispatch($email, $cpaId, $name, $lastName);
        return true;
    }

    public function sendContactFormEmail($data) {
        $email = $data['email'];
        $name = $data['name'];
        $lastName = $data['lastName'];
        $subject = $data['subject'];
        $mensaje = $data['mensaje'];
        ProcessSendContactData::dispatch($email, $name, $lastName, $subject, $mensaje);
        return true;
    }

    public function sendReminderActivationEmail($data) {
        $email = $data['email'];
        $name = $data['name'];
        $lastName = $data['lastName'];
        $subject = $data['subject'];
        $mensaje = $data['mensaje'];
        $token = $data['token'];
        ProcessSendReminderActivationEmail::dispatch($email, $name, $lastName, $subject, $mensaje, $token);
    }

}
