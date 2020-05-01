<?php

namespace App\Jobs;

use App\Mail\RejectApplicationMail;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class ProcessRejectMail implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $email;
    protected $comment;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($email, $comment)
    {
        $this->email = $email;
        $this->comment = $comment;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        Mail::to($this->email)->send(
            new RejectApplicationMail($this->email, $this->comment)
        );
    }
}
