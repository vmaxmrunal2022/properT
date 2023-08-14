<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Throwable;
use Illuminate\Support\Facades\Log;
use Closure;


class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that are not reported.
     *
     * @var array<int, class-string<Throwable>>
     */
    protected $dontReport = [
        //
    ];

    /**
     * A list of the inputs that are never flashed for validation exceptions.
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
     *
     * @return void
     */
    public function register()
    {
        $this->reportable(function (Throwable $e) {
            //
        });
    }

    // public function render($request, Throwable $exception)
    // {
    //     // dd('testing');
    //     // Log 403 error
    //     if ($exception instanceof HttpException && $exception->getStatusCode() === 403) {
    //         Log::error('Forbidden access: ' . $exception->getMessage());
    //     }

    //     return parent::render($request, $exception);
    // }
    public function handle($request, Closure $next)
    {
        $response = $next($request);

        if ($response->getStatusCode()) {
            Log::error('Error : '.$response->getStatusCode() . get_response_description($response->getStatusCode()) . ': ' . $request->url());
        }

        return $response;
    }
}
