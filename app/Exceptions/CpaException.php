<?php


namespace App\Exceptions;


use Throwable;

class CpaException extends \Exception
{
    public function __construct(
        $message = "Contest is not Active - CAP 40001",
        $code = 40001,
        Throwable $previous = null
    ) {
        parent::__construct($message, $code, $previous);
    }
}
