<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Http\Response;
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
     * @param  \Exception  $exception
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
     * @param  \Illuminate\Http\Request  $request
     * @param  \Exception  $exception
     * @return \Symfony\Component\HttpFoundation\Response
     *
     * @throws \Exception
     */
    public function render($request, Exception $exception)
    {
//        if($request->wantsJson()) {
            switch (get_class($exception))
            {
                case AuthenticationException::class:
                    return $this->error('Unauthenticated', Response::HTTP_FORBIDDEN);
                case NotFoundStateException::class:
                case ModelNotFoundException::class:
                case NotFoundHttpException::class:
                    return $this->error('Not found', Response::HTTP_NOT_FOUND);
                case MethodNotAllowedHttpException::class:
                    return $this->error('Method Not Allowed',Response::HTTP_METHOD_NOT_ALLOWED);
                default:
                    return $this->error($exception->getMessage(), $exception->getCode() > 0 ? $exception->getCode() : Response::HTTP_BAD_REQUEST);
                    break;
            }
//        }
        return parent::render($request, $exception);
    }

    private function error($description, $code)
    {
        return response()->json([ 'errors' => [ $description ]  ], $code);
    }
}
