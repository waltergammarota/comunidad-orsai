<?php


namespace App\Classes;


use Throwable;

// TODO change to several Exceptions classes

class UserException extends \Exception
{
    public function __construct(
        $message = "",
        $code = 0,
        Throwable $previous = null
    ) {
        parent::__construct($message, $code, $previous);
    }

    static function getInvalidLengthMessage()
    {
        $maxLength = 3;
        return "Name is shorter than {$maxLength}";
    }

    static function getInvalidCellPhoneMessage()
    {
        return "Cellphone format is not valid";
    }

    static function getInvalidEmailMessage()
    {
        return "Email has no valid format";
    }

    static function getInvalidPasswordMessage()
    {
        $minLength = 8;
        return "Password must have at least {$minLength} characteres";
    }

}
