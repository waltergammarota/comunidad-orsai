<?php

namespace App\Exceptions;

use App\Classes\UserAlreadyVerifiedException;
use App\Classes\UserException;
use App\Classes\UserNotFoundException;
use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Support\Facades\Redirect;

class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that are not reported.
     *
     * @var array
     */
    protected $dontReport = [
        \App\Classes\UserException::class
    ];

    /**
     * A list of the inputs that are never flashed for validation exceptions.
     *
     * @var array
     */
    protected $dontFlash = [
        'password',
        'password_confirmation',
    ];

    /**
     * Report or log an exception.
     *
     * @param \Exception $exception
     * @return void
     *
     * @throws \Exception
     */
    public function report(Exception $exception)
    {
        parent::report($exception);
    }

    /**
     * Render an exception into an HTTP response.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Exception $exception
     * @return \Symfony\Component\HttpFoundation\Response
     *
     * @throws \Exception
     */
    public function render($request, Exception $exception)
    {
        if ($exception instanceof UserException) {
            return UserExceptionHttp::returnErrorResponse($exception);
        }
        if ($exception instanceof UserNotFoundException) {
            return Redirect::to('reenviar-mail');
        }

        if ($exception instanceof UserAlreadyVerifiedException) {
            return Redirect::to('panel');
        }

        if ($this->isHttpException($exception)) {
            $code = $exception->getStatusCode();
            switch ($code) {
                case 404:
                    $data = session('last_values');
                    return response()->view('errors.404', $data, 404);
                    break;
                case 403:
                    return Redirect::to('panel');
                    break;
            }
        }


        return parent::render($request, $exception);
    }
}
