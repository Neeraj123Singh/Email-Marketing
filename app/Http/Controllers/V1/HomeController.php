<?php

/**
 * HomeController.php
 * 
 * @since 23 Aug, 2020
 * @copyright Grorapid @ 2020
 * @author Manish Sahani <rec.manish.sahani@gmail.com>
 */

namespace App\Http\Controllers\V1;

use App\Http\Controllers\Controller;
use App\Http\Http;

class HomeController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | HomeController  
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling all non-informative routes, 
    | like home and privacy policy and stuff.
    |
    */

    /**
     * Handler for the / route 
     * 
     * @api GET /api/
     * @see {collection doc link}
     * @return \Illuminate\Http\JsonResponse
     */
    public function handle()
    {
        return $this->response->json(config('message.welcome'), Http::RESPONSE_STATUS_CODE_OK);
    }

    /**
     * Handler for the home route
     * 
     * @api GET /api/home
     * @see {collection doc link}
     * @return \Illuminate\Http\JsonResponse
     */
    public function home()
    {
        return $this->response->json(['user' => auth()->user()], Http::RESPONSE_STATUS_CODE_OK);
    }
}
