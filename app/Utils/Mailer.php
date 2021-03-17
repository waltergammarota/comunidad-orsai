<?php


namespace App\Utils;


use App\Jobs\ProcessActivationMail;
use App\Jobs\ProcessApproveMail;
use App\Jobs\ProcessDonationMail;
use App\Jobs\ProcessReclamoMail;
use App\Jobs\ProcessRejectMail;
use App\Jobs\ProcessResetPasswordMail;
use App\Jobs\ProcessSendContactData;
use App\Jobs\ProcessSendMailToAdministrator;
use App\Jobs\ProcessSendReminderActivationEmail;
use App\Jobs\ProcessWelcomePointsMail;

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

    public function sendMailToAdministrator($email, $cpaId, $name, $lastName)
    {
        ProcessSendMailToAdministrator::dispatch($email, $cpaId, $name, $lastName);
        return true;
    }

    public function sendContactFormEmail($data)
    {
        $email = $data['email'];
        $name = $data['name'];
        $lastName = $data['lastName'];
        $subject = $data['subject'];
        $mensaje = $data['mensaje'];
        ProcessSendContactData::dispatch($email, $name, $lastName, $subject, $mensaje);
        return true;
    }

    public function sendReminderActivationEmail($data)
    {
        $email = $data['email'];
        $name = $data['name'];
        $lastName = $data['lastName'];
        $subject = $data['subject'];
        $mensaje = $data['mensaje'];
        $token = $data['token'];
        ProcessSendReminderActivationEmail::dispatch($email, $name, $lastName, $subject, $mensaje, $token);
    }

    public function sendDonationEmail($data)
    {
        $email = $data['email'];
        $fichas = $data['fichas'];
        $paymentId = $data['paymentId'];
        $fecha = $data['fecha'];
        $productName = $data['productName'];
        $amount = $data['amount'];
        $donante = $data['donante'];
        $amount_ars = $data['amount_ars'];
        $payment_processor = $data['payment_processor'];
        ProcessDonationMail::dispatch($email, $fichas, $paymentId, $fecha, $productName, $amount, $amount_ars, $payment_processor, $donante);
    }

    public function sendReclamo($txId, $reclamo)
    {
        ProcessReclamoMail::dispatch($txId, $reclamo);
    }

}
