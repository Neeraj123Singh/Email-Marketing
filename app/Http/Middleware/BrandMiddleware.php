<?php

namespace App\Http\Middleware;

use App\Http\Http;
use App\Utilities\BrandUtility;
use Closure;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpKernel\Exception\HttpException;

class BrandMiddleware
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
        if ( $request->has('buuid') ) {
            $request->merge([
                'brand' => BrandUtility::firstOrFail(Auth::user(), $request->buuid),
            ]);
            
            return $next($request);
        }

        throw new HttpException(Http::RESPONSE_STATUS_CODE_UNPROCESSABLE_ENTRY, config('message.error.brand.missing_uuid'));
    }
}
