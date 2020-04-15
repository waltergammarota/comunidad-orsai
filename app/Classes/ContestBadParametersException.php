<?php


namespace App\Classes;


use Throwable;

class ContestBadParametersException extends \Exception
{
    public function __construct(
        $message = "Bad parameters",
        $code = 30000,
        Throwable $previous = null
    ) {
        parent::__construct($message, $code, $previous);
    }
}
