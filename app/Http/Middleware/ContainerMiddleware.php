<?php

namespace App\Http\Middleware;

use Closure;

class ContainerMiddleware
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
        // if ( $request->has() )
        return $next($request);
    }
}
