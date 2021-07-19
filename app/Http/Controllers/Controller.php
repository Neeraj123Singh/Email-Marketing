<?php

namespace App\Http\Controllers;

use App\Http\Response\DefaultResponseV1;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    protected $response;

    /**
     * Constructor 
     * 
     * @param 
     */
    public function __construct(DefaultResponseV1 $response)
    {
        $this->response = $response;
    }
}
