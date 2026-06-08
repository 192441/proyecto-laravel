<?php

namespace App\Exceptions;

use App\Exceptions\NotFoundHttpException;
use App\Exceptions\AccessDeniedHttpException;
use App\Exceptions\SessionExpiredHttpException;
use App\Exceptions\InternalServerErrorHttpException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Throwable;

class Handler extends ExceptionHandler
{
    public function render($request, Throwable $exception)
    {
        if ($exception instanceof NotFoundHttpException) {
            return $exception->render($request);
        }
        
        if ($exception instanceof AccessDeniedHttpException) {
            return $exception->render($request);
        }
        
        if ($exception instanceof SessionExpiredHttpException) {
            return $exception->render($request);
        }
        
        if ($exception instanceof InternalServerErrorHttpException) {
            return $exception->render($request);
        }

        return parent::render($request, $exception);
    }
}