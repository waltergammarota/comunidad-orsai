<?php

namespace App\Jobs;

use App\Mail\ApproveApplicationMail;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class ProcessApproveMail implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $email;
    protected $cpaId;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($email, $cpaId)
    {
        $this->email = $email;
        $this->cpaId = $cpaId;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        Mail::to($this->email)->send(new ApproveApplicationMail($this->email, $this->cpaId));
    }
}
