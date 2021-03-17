<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ReclamoMail extends Mailable
{
    use Queueable, SerializesModels;

    protected $txId;
    protected $reclamo;

    public function __construct($txId, $reclamo)
    {
        $this->txId = $txId;
        $this->reclamo = $reclamo;
    }

    public function build()
    {
        $data = [
            "txId" => $this->txId,
            "reclamo" => $this->reclamo
        ];
        return $this->subject('Reclamo sobre transacción id ' . $this->txId)->view(
            'mails.reclamo',
            $data
        );
    }
}
