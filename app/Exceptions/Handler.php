<?php

namespace App\Exceptions;

use App\Http\Http;
use App\Http\Response\DefaultResponseV1;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Http\Response;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\ValidationException;
use Laravel\Passport\Exceptions\OAuthServerException;
use League\OAuth2\Server\Exception\OAuthServerException as ExceptionOAuthServerException;
use Symfony\Component\HttpKernel\Exception\HttpException;
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
     * @param  \Throwable  $exception
     * @return void
     *
     * @throws \Exception
     */
    public function report(Throwable $exception)
    {
        parent::report($exception);
    }

    /**
     * Convert the given exception to an array.
     *
     * @param  \Throwable  $e
     * @return array
     */
    protected function convertExceptionToArray(Throwable $e)
    {
        return config('app.debug') 
            ? DefaultResponseV1::generate(
                Http::RESPONSE_STATUS_ERROR,
                [
                    'message' => $e->getMessage(),
                    'exception' => get_class($e),
                    'file' => $e->getFile(),
                    'line' => $e->getLine(),
                    'trace' => collect($e->getTrace())->map(function ($trace) {
                        return Arr::except($trace, ['args']);
                    })->all(),
                ],
                $this->isHttpException($e) ? $e->getStatusCode() : Http::RESPONSE_STATUS_CODE_SERVER_ERROR,
            )
            : DefaultResponseV1::generate(
                Http::RESPONSE_STATUS_ERROR,
                [
                    'message' => $this->isHttpException($e) ? $e->getMessage() : 'Server Error',
                ],
                $this->isHttpException($e) ? $e->getStatusCode() : Http::RESPONSE_STATUS_CODE_SERVER_ERROR,
                Response::$statusTexts[$this->isHttpException($e) ? $e->getStatusCode() : Http::RESPONSE_STATUS_CODE_SERVER_ERROR]
            );
    }

    /**
     * Convert a validation exception into a JSON response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Illuminate\Validation\ValidationException  $exception
     * @return \Illuminate\Http\JsonResponse
     */
    protected function invalidJson($request, ValidationException $exception)
    {
        $data = DefaultResponseV1::generate(
            Http::RESPONSE_STATUS_ERROR,
            [
                'message' => $exception->getMessage(),
                'errors' => $exception->errors(),
            ],
            $exception->status
        );
        
        return response()->json($data, $exception->status);
    }

    /**
     * Render an exception into an HTTP response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Throwable  $exception
     * @return \Symfony\Component\HttpFoundation\Response
     *
     * @throws \Throwable
     */
    public function render($request, Throwable $exception)
    {
        $request->headers->set('Accept', Http::REQUEST_ACCEPT);  

        return parent::render($request, $exception);
    }
}
