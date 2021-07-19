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
use App\Http\Requests\LoginRequest;
use App\User;
use App\Utilities\AuthenticationUtility;
use Symfony\Component\HttpKernel\Exception\HttpException;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | LoginController  
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling user authentication requests 
    | and uses Authentication Utility.
    |
    */

    /**
     * Handle a login attempt.
     *
     * @param  \Illuminate\Http\Request $request
     * @return Response
     */
    public function handle(LoginRequest $request)
    {
        $creds = $request->only([User::SCHEMA_EMAIL, User::SCHEMA_PASSWORD]);

        if (!$user = AuthenticationUtility::check($creds)) {
            throw new HttpException(
                Http::RESPONSE_STATUS_CODE_UNAUTHORIZED, 
                config('message.error.auth.invalid_password')
            );
        }

        $token = $user->createToken('Authorization')->accessToken;

        return $this->response->json([ 
            'token' => $token,
            'user'  => $user 
        ], Http::RESPONSE_STATUS_CODE_OK);
    }

}
