<?php

namespace App\Jobs;

use App\Mail\WelcomeMail;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class ProcessWelcomePointsMail implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $email;
    protected $name;
    protected $lastname;
    protected $amount;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($email,$name,$lastname,$amount)
    {
        $this->email = $email;
        $this->name = $name;
        $this->lastname = $lastname;
        $this->amount = $amount;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        Mail::to($this->email)->send(new WelcomeMail($this->email,$this->name,$this->lastname, $this->amount ,url('/ingresar/')));
    }
}
