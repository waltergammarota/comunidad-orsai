<?php

namespace App\Jobs;

use App\Mail\SendEmailToAdministrator;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class ProcessSendMailToAdministrator implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $administratorEmail;
    protected $email;
    protected $cpaId;
    protected $name;
    protected $lastName;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($email, $cpaId, $name, $lastName)
    {
        $this->administratorEmail = env('ADMINISTRATOR_EMAIL', 'kelsie.kutch3@ethereal.email');
        $this->email = $email;
        $this->cpaId = $cpaId;
        $this->name = $name;
        $this->lastName = $lastName;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        Mail::to($this->administratorEmail)->send(new SendEmailToAdministrator($this->email, $this->cpaId, $this->name, $this->lastName));
    }
}
