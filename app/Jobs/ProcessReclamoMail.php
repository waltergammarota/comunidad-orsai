<?php

namespace App\Jobs;

use App\Mail\ReclamoMail;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class ProcessReclamoMail implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $txId;
    protected $email;
    protected $reclamo;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($txId, $reclamo)
    {
        $this->email = "editorialorsai+comunidad@gmail.com";
        $this->txId = $txId;
        $this->reclamo = $reclamo;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        Mail::to($this->email)->send(new ReclamoMail($this->txId, $this->reclamo));
    }
}
