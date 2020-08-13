<?php

namespace App\Exceptions;

use App\Adapters\Monolog\MonologLogAdapter;
use App\Http\Middleware\HeadersMiddleware;
use Illuminate\Http\Response;
use Throwable;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Support\Facades\App;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

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
     * @param Throwable $exception
     * @throws \Exception
     */
    public function report(Throwable $exception)
    {
        parent::report($exception);
    }

    /**
     * Render an exception into an HTTP response.
     *
     * @param \Illuminate\Http\Request $request
     * @param Throwable $exception
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\JsonResponse|\Illuminate\Http\Response|\Symfony\Component\HttpFoundation\Response
     * @throws Throwable
     */
    public function render($request, Throwable $exception)
    {
        if (App::environment('local')) {
            return parent::render($request, $exception);
        }

        if ($exception instanceof NotFoundHttpException) {
            return $this->getResponse(Response::HTTP_NOT_FOUND);
        }

        if ($exception instanceof MethodNotAllowedHttpException) {
            return $this->getResponse(Response::HTTP_METHOD_NOT_ALLOWED);
        }

        if ($exception instanceof ValidationException) {
            return $this->getResponse(Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        (new MonologLogAdapter($request->headers->get(HeadersMiddleware::X_TRACEID)))->error(
            Response::$statusTexts[Response::HTTP_INTERNAL_SERVER_ERROR],
            ['exception' => $exception]
        );

        return $this->getResponse(Response::HTTP_INTERNAL_SERVER_ERROR);
    }

    private function getResponse(int $httResponseCode)
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
