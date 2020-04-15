<?php


namespace App\Classes;
use Throwable;

class UserNotFoundException extends \Exception
{
    public function __construct(
        $message = "User not found",
        $code = 10003,
        Throwable $previous = null
    ) {
        parent::__construct($message, $code, $previous);
    }

}
