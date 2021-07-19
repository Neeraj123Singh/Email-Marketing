<?php

/**
 * RegisterController.php
 * 
 * @since 23 Aug, 2020
 * @copyright Grorapid @ 2020
 * @author Manish Sahani <rec.manish.sahani@gmail.com>
 */

namespace App\Http\Controllers\auth;

use App\Http\Controllers\Controller;
use App\Http\Http;
use App\Http\Requests\RegisterRequest;
use App\Utilities\UserUtility;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | RegisterController  
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling user registration requests 
    | and uses UserUtility.
    |
    */

    /**
     * Handle a registration attempt.
     *
     * @api POST /api/register 
     * @see {}
     * @param  \App\Http\Requests\RegisterRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function handle(RegisterRequest $request)
    {
        $user = UserUtility::create($request->all());

        return $this->response->json($user, Http::RESPONSE_STATUS_CODE_CREATED);
    }
}
