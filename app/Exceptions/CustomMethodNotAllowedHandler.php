<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Foundation\Exceptions\Handler;
use Symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException;
use Throwable;

class CustomMethodNotAllowedHandler extends Handler
{
    public function render($request, Throwable $e)
    {
        if ($e instanceof MethodNotAllowedHttpException) {
            return response()
                ->view('errors.404', [], 404);
        }
        return parent::render($request, $e);
    }
}
