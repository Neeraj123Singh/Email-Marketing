<?php

/**
 * BrandController.php
 * 
 * @since 27 Aug, 2020
 * @copyright Grorapid @ 2020
 * @author Manish Sahani <rec.manish.sahani@gmail.com>
 */

namespace App\Http\Controllers\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\BrandRequest;
use App\Utilities\BrandUtility;
use Illuminate\Support\Facades\Auth;

class BrandController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | BrandController  
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling user's brand related requests 
    | and uses BrandUtility.
    |
    */

    /**
     * Handle a request to get all brands.
     *
     * @api GET /api/brand/ 
     * @see {collection doc link}
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        return $this->response->json([
            'brands' => auth()->user()->brands()->get(),
        ]);
    }

    /**
     * Handle a request to create a new brand.
     *
     * @api POST /api/brands/ 
     * @see {collection doc link}
     * @param \App\Http\Requests\BrandRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function create(BrandRequest $request)
    {
        return "Create Brands";
        return $this->response->json([
            'brands' => BrandUtility::create(Auth::user(), $request->all()),
        ]);
    }

    /**
     * Handle a request to get a specific brands.
     *
     * @api GET /api/brand/{uuid}
     * @see {collection doc link}
     * @return \Illuminate\Http\JsonResponse
     */
    public function get($uuid)
    {
        return $this->response->json([
            'brand' => BrandUtility::firstOrFail(Auth::user(), $uuid),
        ]);
    }
}
