<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class DonationMail extends Mailable
{
    use Queueable, SerializesModels;

    protected $fichas;
    protected $paymentId;
    protected $fecha;
    protected $productName;
    protected $amount;
    protected $donante;

    public function __construct($fichas, $paymentId, $fecha, $productName, $amount, $donante)
    {
        $this->fichas = $fichas;
        $this->paymentId = $paymentId;
        $this->fecha = $fecha;
        $this->productName = $productName;
        $this->amount = $amount;
        $this->donante = $donante;
    }

    public function build()
    {
        $data = [
            "fichas" => $this->fichas,
            "paymentId" => $this->paymentId,
            "fecha" => $this->fecha,
            "productName" => $this->productName,
            "amount" => $this->amount,
            "donante" => $this->donante
        ];
        return $this->subject('¡Hiciste una donación a Comunidad Orsai!')->view(
            'mails.detalle_donacion',
            $data
        );
    }
}
