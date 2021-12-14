<?php

namespace App\Exceptions;

use App\Http\Middleware\HeadersMiddleware;
use Arquivei\LogAdapter\Log;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\App;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpFoundation\Response as HttpResponse;
use Symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Throwable;

class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that are not reported.
     *
     * @var array
     */
    protected $dontReport = [
        //
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
     * @throws Throwable
     */
    public function report(Throwable $e)
    {
        parent::report($e);
    }

    /**
     * Render an exception into an HTTP response.
     *
     * @param Request $request
     * @throws Throwable
     */
    public function render($request, Throwable $e): Response
    {
        if (App::environment('local')) {
            return parent::render($request, $e);
        }

        if ($e instanceof NotFoundHttpException) {
            return $this->getResponse(HttpResponse::HTTP_NOT_FOUND);
        }

        if ($e instanceof MethodNotAllowedHttpException) {
            return $this->getResponse(HttpResponse::HTTP_METHOD_NOT_ALLOWED);
        }

        if ($e instanceof ValidationException) {
            return $this->getResponse(HttpResponse::HTTP_UNPROCESSABLE_ENTITY);
        }

        /** @var Log $logger */
        $logger = app(Log::class);
        $logger->setTraceId($request->headers->get(HeadersMiddleware::X_TRACEID));
        $logger->error(
            Response::$statusTexts[HttpResponse::HTTP_INTERNAL_SERVER_ERROR],
            ['exception' => $e]
        );

        return $this->getResponse(HttpResponse::HTTP_INTERNAL_SERVER_ERROR);
    }

    private function getResponse(int $httResponseCode): Response
    {
        return response([
            'status' => [
                'message' => sprintf(
                    '%s:%s',
                    env('APP_IDENTIFIER'),
                    Response::$statusTexts[$httResponseCode]
                ),
                'code' => $httResponseCode
            ],
        ], $httResponseCode);
    }
}
