<?php

namespace App\Jobs;

use App\Mail\SendReminderActivationEmail;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class ProcessSendReminderActivationEmail implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $email;
    protected $name;
    protected $lastName;
    protected $subject;
    protected $mensaje;
    protected $sentTo;
    protected $token;

    public function __construct($email, $name, $lastName, $subject, $mensaje, $token)
    {
        $this->email = $email;
        $this->name = $name;
        $this->lastName = $lastName;
        $this->subject = $subject;
        $this->mensaje = $mensaje;
        $this->token = $token;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        Mail::to($this->email)->send(new SendReminderActivationEmail($this->email, $this->subject, $this->mensaje, $this->name, $this->lastName, $this->token));
    }
}
