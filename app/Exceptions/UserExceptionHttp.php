<?php


namespace App\Exceptions;


use App\Classes\UserException;

class UserExceptionHttp
{
    static function returnErrorResponse(UserException $userException)
    {
        switch ($userException->getCode()) {
            case 10000:
                return response()->json(
                    [
                        "message" => $userException->getMessage(),
                        "errorCode" => $userException->getCode()
                    ],
                    409
                );
            default:
                return response()->json(
                    [
                        "message" => $userException->getMessage(),
                        "errorCode" => $userException->getCode()
                    ],
                    400
                );
                break;
        }
    }
}
