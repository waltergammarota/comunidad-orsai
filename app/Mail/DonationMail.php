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
    protected $amount_ars;
    protected $donante;
    protected $payment_processor;

    public function __construct($fichas, $paymentId, $fecha, $productName, $amount, $amount_ars, $payment_processor, $donante)
    {
        $this->fichas = $fichas;
        $this->paymentId = $paymentId;
        $this->fecha = $fecha;
        $this->productName = $productName;
        $this->amount = $amount;
        $this->amount_ars = $amount_ars;
        $this->payment_processor = $payment_processor;
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
            "payment_processor" => $this->payment_processor,
            "amount_ars" => $this->amount_ars,
            "donante" => $this->donante
        ];
        return $this->subject('¡Hiciste una donación a Comunidad Orsai!')->view(
            'mails.detalle_donacion',
            $data
        );
    }
}
