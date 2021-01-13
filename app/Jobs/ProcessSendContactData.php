<?php

namespace App\Jobs;

use App\Mail\ApproveApplicationMail;
use App\Mail\SendContactDataMail;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class ProcessSendContactData implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $email;
    protected $name;
    protected $lastName;
    protected $subject;
    protected $mensaje;
    protected $sentTo;

    public function __construct($email, $name, $lastName, $subject, $mensaje)
    {
        $this->email = $email;
        $this->name = $name;
        $this->lastName = $lastName;
        $this->subject = $subject;
        $this->mensaje = $mensaje;
        $this->sentTo = "info@comunidadorsai.org";
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        Mail::to($this->sentTo)->send(new SendContactDataMail($this->email, $this->subject, $this->mensaje, $this->name, $this->lastName));
    }
}
