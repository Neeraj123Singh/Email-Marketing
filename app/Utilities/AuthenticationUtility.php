<?php

/**
 * AuthenticationUtility.php
 * 
 * @since 23 Aug, 2020
 * @copyright Grorapid @ 2020
 * @author Manish Sahani <rec.manish.sahani@gmail.com>
 */

namespace App\Utilities;

use App\Http\Http;
use App\Http\Response\DefaultErrorResponse;
use App\Http\Response\DefaultResponseV1;
use App\Traits\HelperTrait;
use App\User;
use Exception;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpKernel\Exception\HttpException;

class AuthenticationUtility
{
    ///////////////////////////////////////////////////////////////////////////
    //  Authentication Utility
    ///////////////////////////////////////////////////////////////////////////
    // 
    //  The utility is responsible for handling all the authentication related 
    //  queries.
    // 
    ///////////////////////////////////////////////////////////////////////////

    /**
     * Check the credentials matches to a user or not 
     * 
     * @param array $data
     * @return mixed
     */
    public static function check(array $data)
    {
        $user = UserUtility::find($data[User::SCHEMA_EMAIL], User::SCHEMA_EMAIL);

        return Hash::check($data[User::SCHEMA_PASSWORD], $user->password) ? $user : null;
    }
}
