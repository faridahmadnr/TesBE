<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Throwable;

class Handler extends ExceptionHandler
{
    /**
     * The list of the inputs that are never flashed to the session on validation exceptions.
     *
     * @var array<int, string>
     */
    protected $dontFlash = [
        'current_password',
        'password',
        'password_confirmation',
    ];

    /**
     * Register the exception handling callbacks for the application.
     */
    public function register(): void
    {
        $this->reportable(function (Throwable $e) {
            //
        });

        $this->renderable(function (NotFoundHttpException $e, $request) {
            if ($request->is('api/*')) {
                return response()->json([
                    'apiVersion' => '1.0',
                    'error' => [
                        'code' => 404,
                        'message' => 'Not Found',
                    ],
                ], 404);
            }
        });

        $this->renderable(function (\Illuminate\Auth\AuthenticationException $e, $request) {
            if ($request->is('api/*')) {
                return response()->json([
                    'apiVersion' => '1.0',
                    'error' => [
                        'code' => 401,
                        'message' => 'Unauthenticated',
                    ],
                ], 401);
            }
        });

        $this->renderable(function (ValidationException $e, $request) {
            if ($request->is('api/*')) {
                return response()->json([
                    'apiVersion' => '1.0',
                    'message' => $e->getMessage(),
                    'errors' => $e->errors(),
                ], $e->status);
            }
        });

        $this->renderable(function (AccessDeniedHttpException $e, $request) {
            if ($request->is('api/*')) {
                return response()->json([
                    'apiVersion' => '1.0',
                    'message' => $e->getMessage(),
                ], 403);
            }
        });

        $this->renderable(function (HttpException $e, $request) {
            if ($request->is('api/*')) {
                return response()->json([
                    'apiVersion' => '1.0',
                    'message' => $e->getMessage(),
                ], 403);
            }
        });
    }
}
