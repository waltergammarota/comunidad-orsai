<?php


namespace App\Classes;


use Throwable;

class CreateContestException extends \Exception
{
    public function __construct(
        $message = "The user has no permission to create a Contest",
        $code = 30001,
        Throwable $previous = null
    ) {
        parent::__construct($message, $code, $previous);
    }
}
