<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Support\Facades\Log;
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
     * @return \Illuminate\Http\Response
     */
    public function render($request, Exception $exception)
    {
        $request_url = $request->getPathInfo();
        if (strpos($request_url, '/api/') !== false) {
            $error_message = $exception->getMessage();
            $error_file = $exception->getFile();
            $error_file_line = $exception->getLine();
            Log::error('url: ' . $request_url . ', ' . $error_file . ': ' . $error_file_line  . ', error: ' . $error_message);
            return response()->json([
                'code' => '400',
                'msg' => '请求出错',
                'data' => ''
            ]);
        }
        if (strpos($request_url, '/img/') === false) {
            $error_message = $exception->getMessage();
            $error_file = $exception->getFile();
            $error_file_line = $exception->getLine();
            Log::error('url: ' . $request_url . ', ' . $error_file . ': ' . $error_file_line  . ', error: ' . $error_message);
        }
        return redirect('/error');
        // return parent::render($request, $exception);
    }
}
