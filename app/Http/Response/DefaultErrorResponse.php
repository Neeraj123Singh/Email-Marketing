<?php

/**
 * DefaultErrorResponse.php
 * 
 * @since 23 Aug, 2020
 * @copyright Grorapid @ 2020
 * @author Manish Sahani <rec.manish.sahani@gmail.com>
 */

namespace App\Http\Response;

use App\Http\Http;

class DefaultErrorResponse 
{
    public $message, $code, $status;

    /**
     * Return Error as response 
     * 
     */
    public function __construct($message, $code, $status = null)
    {
        $this->message = $message;
        $this->code    = $code;
        $this->status  = $status ? $status : Http::RESPONSE_STATUS_ERROR;
    }
}