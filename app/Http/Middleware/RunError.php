<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Log;

class RunError
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $response = $next($request);
        if ($response->getStatusCode() == 500) {
            $error_message = $response->exception->getMessage();
            $error_file = $response->exception->getFile();
            $error_file_line = $response->exception->getLine();
            $request_url = $request->getPathInfo();
            Log::error('url: ' . $request_url . ', ' . $error_file . ': ' . $error_file_line  . ', error: ' . $error_message);
            return redirect('/error');
        }
        return $response;
    }
}
