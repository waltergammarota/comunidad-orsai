<?php

namespace App\Jobs;

use App\Mail\ActivationMail;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class ProcessActivationMail implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $email;
    protected $name;
    protected $lastName;
    protected $token;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($email, $name, $lastName, $token)
    {
        $this->email = $email;
        $this->name = $name;
        $this->lastName = $lastName;
        $this->token = $token;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        Mail::to($this->email)->send(
            new ActivationMail(
                $this->name,
                $this->lastName,
                url('/activar/' . $this->token)
            )
        );
    }
}
