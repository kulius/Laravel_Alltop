<?php

namespace App\Http\Middleware\Alltop;

use Closure;

class XssProtectionMiddleware
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
        $response->headers->set('X-XSS-Protection', 0);
        return $response;
    }
}
