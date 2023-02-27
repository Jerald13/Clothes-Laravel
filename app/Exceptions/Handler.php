<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Throwable;
use Illuminate\Http\Response;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Exception;

class Handler extends ExceptionHandler
{
    /**
     * A list of exception types with their corresponding custom log levels.
     *
     * @var array<class-string<\Throwable>, \Psr\Log\LogLevel::*>
     */
    protected $levels = [
        //
    ];

    /**
     * A list of the exception types that are not reported.
     *
     * @var array<int, class-string<\Throwable>>
     */
    protected $dontReport = [
        //
    ];

    /**
     * A list of the inputs that are never flashed to the session on validation exceptions.
     *
     * @var array<int, string>
     */
    protected $dontFlash = [
        "current_password",
        "password",
        "password_confirmation",
    ];

    /**
     * Register the exception handling callbacks for the application.
     *
     * @return void
     */
    public function register()
    {
        $this->renderable(function (Exception $e, $request) {
            return $this->render($request, $e);
        });
        // $this->reportable(function (Throwable $e) {
        //     //
        // });
    }

    public function render($request, Throwable $exception)
    {
        if ($exception instanceof ValidationException) {
            return response()->json(
                [
                    "message" => "The given data was invalid.",
                    "errors" => $exception->validator->getMessageBag(),
                ],
                Response::HTTP_UNPROCESSABLE_ENTITY
            );
        } elseif (
            $exception instanceof NotFoundHttpException ||
            $exception instanceof ModelNotFoundException
        ) {
            return response()->view(
                "errors.page-404",
                [],
                Response::HTTP_NOT_FOUND
            );
        } elseif ($exception instanceof MethodNotAllowedHttpException) {
            return response()->view(
                "errors.page-405",
                [],
                Response::HTTP_METHOD_NOT_ALLOWED
            );
        } else {
            return response()->view(
                "errors.page-500",
                [],
                Response::HTTP_INTERNAL_SERVER_ERROR
            );
        }
    }
}
