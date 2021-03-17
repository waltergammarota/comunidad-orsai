<?php

namespace App\Jobs;

use App\Mail\ReclamoMail;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class ProcessDonationMail implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $email;
    protected $fichas;
    protected $paymentId;
    protected $fecha;
    protected $productName;
    protected $amount;
    protected $donante;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($email, $fichas, $paymentId, $fecha, $productName, $amount, $donante)
    {
        $this->email = $email;
        $this->fichas = $fichas;
        $this->paymentId = $paymentId;
        $this->fecha = $fecha;
        $this->productName = $productName;
        $this->amount = $amount;
        $this->donante = $donante;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        Mail::to($this->email)->send(new ReclamoMail($this->fichas, $this->paymentId, $this->fecha, $this->productName, $this->amount, $this->donante));
    }
}
