<?php

namespace App\Exceptions;

use App\Trait\ApiResponse;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;
use Symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Throwable;

class Handler extends ExceptionHandler
{

    use ApiResponse;

    protected $dontReport = [];

    protected $dontFlash = [
        'current_password',
        'password',
        'password_confirmation',
    ];

    public function register(): void
    {
        $this->reportable(function (Throwable $e) {
            //
        });
    }

    // for manage exception in laravel ==============================================
    public function render($request, Throwable $e): Response|JsonResponse|\Symfony\Component\HttpFoundation\Response
    {
        if ($e instanceof ModelNotFoundException) {
            return $this->errorResponse(404, $e->getMessage());
        }
        if ($e instanceof NotFoundHttpException) {
            return $this->errorResponse(404, $e->getMessage());
        }
        if ($e instanceof MethodNotAllowedHttpException) {
            return $this->errorResponse(405, $e->getMessage());
        }
        if ($e instanceof Exception) {
            return $this->errorResponse(404, $e->getMessage());
        }
        // show error html get in dev apps and not show error html in client and user =============================
        if (config('app.debug')) {
            return Parent::render($request, $e);
        }
        return $this->errorResponse(500, 'server error');
    }

}
