<?php

namespace App\Exceptions;

use Exception;

class SessionExpiredHttpException extends Exception
{
    public function render($request)
    {
        return response()->view('errors.419', [], 419);
    }
}