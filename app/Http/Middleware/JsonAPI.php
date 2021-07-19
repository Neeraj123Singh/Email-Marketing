<?php

/**
 * JsonAPI.php
 * 
 * @since 23 Aug, 2020
 * @copyright Grorapid @ 2020
 * @author Manish Sahani <rec.manish.sahani@gmail.com>
 */

namespace App\Http\Middleware;

use Closure;
use App\Http\Http;
use App\Http\Response\DefaultErrorResponse;
use App\Http\Response\DefaultResponseV1;
use Illuminate\Support\Facades\Log;

class JsonAPI
{
    /*
    |--------------------------------------------------------------------------
    | JsonAPI - Custom Middleware 
    |--------------------------------------------------------------------------
    |
    | This middleware is responsible for the formatting of the Response as acc-
    | ording to the defined structure.
    |
    */

    /**
     * The default response object for the API
     * 
     * @var DefaultResponseV1
     */
    protected $defaultResponse;

    protected $success = [
        Http::RESPONSE_STATUS_CODE_OK,
        Http::RESPONSE_STATUS_CODE_CREATED
    ];

    /**
     * JsonMiddleware constructor.
     * 
     * @param DefaultResponseV1 $defaultResponse
     */
    public function __construct(DefaultResponseV1 $defaultResponse)
    {
        $this->defaultResponse = $defaultResponse;
    }

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        // update the accept type of the request according to the api, 
        // so that the request can be processed in other parts of the app.
        $request->headers->set('Accept', Http::REQUEST_ACCEPT);
        return $next($request);
    }
}
