<?php


namespace App\Classes;


use Throwable;

class EditContestException extends \Exception
{
    public function __construct(
        $message = "The user has no permission to edit contest",
        $code = 0,
        Throwable $previous = null
    ) {
        parent::__construct($message, $code, $previous);
    }
}
