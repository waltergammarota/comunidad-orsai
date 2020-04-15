<?php


namespace App\Classes;


class TransactionInvalidaTypeException extends \Exception
{
    public function __construct(
        $message = "Invalid Type",
        $code = 20001,
        Throwable $previous = null
    ) {
        parent::__construct($message, $code, $previous);
    }


}
