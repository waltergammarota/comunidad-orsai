<?php


namespace App\Classes;
use Throwable;

class UserAlreadyVerifiedException extends \Exception
{
    public function __construct(
        $message = "User already verified",
        $code = 10004,
        Throwable $previous = null
    ) {
        parent::__construct($message, $code, $previous);
    }

}
