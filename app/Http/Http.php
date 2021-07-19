<?php

/**
 * Http.php
 * 
 * @since 23 Aug, 2020
 * @copyright Grorapid @ 2020
 * @author Manish Sahani <rec.manish.sahani@gmail.com>
 */


namespace App\Http;

class Http
{
    /*
    |--------------------------------------------------------------------------
    | Http
    |--------------------------------------------------------------------------
    |
    | Here is where all the response and request related properties are defined
    | that are used all over the place.
    |
    */

    ///////////////////////////////////////////////////////////////////////////
    // 
    //  Request Properties and methods 
    // 
    ///////////////////////////////////////////////////////////////////////////
    public const REQUEST_ACCEPT = 'application/json';

    ///////////////////////////////////////////////////////////////////////////
    // 
    //  Response Properties and methods
    // 
    ///////////////////////////////////////////////////////////////////////////
    public const RESPONSE_STATUS_OK     = true;
    public const RESPONSE_STATUS_ERROR  = false;
    public const RESPONSE_STATUS_OK_MESSAGE = "success";
    public const RESPONSE_STATUS_ERROR_MESSAGE = "error";

    public const RESPONSE_STATUS_CODE_OK                    = 200;
    public const RESPONSE_STATUS_CODE_CREATED               = 201;
    public const RESPONSE_STATUS_CODE_UNAUTHORIZED          = 401;
    public const RESPONSE_STATUS_CODE_NOT_FOUND             = 404;
    public const RESPONSE_STATUS_CODE_METHOD_NOT_ALLOWED    = 405;
    public const RESPONSE_STATUS_CODE_UNPROCESSABLE_ENTRY   = 422;
    public const RESPONSE_STATUS_CODE_SERVER_ERROR          = 500;
    
    public const RESPONSE_CONTENT_TYPE = 'application/json';
}
