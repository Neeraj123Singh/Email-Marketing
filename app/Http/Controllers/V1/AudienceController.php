<?php

/**
 * AudienceController.php
 *
 * @since 30 Aug, 2020
 * @copyright Grorapid @ 2020
 * @author Manish Sahani <rec.manish.sahani@gmail.com>
 */

namespace App\Http\Controllers\V1;

use App\Http\Controllers\Controller;
use App\Utilities\ContainerUtility;
use App\Utilities\TypeUtility;

class AudienceController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | AudienceController
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling brand's audience related
    | requests  and uses BrandUtility.
    |
    */

    /**
     * Handle a request to get a specific brands.
     *
     * @api GET /api/brand/{uuid}
     * @see {collection doc link}
     * @return \Illuminate\Http\JsonResponse
     */
    public function get($cuuid)
    {
        return $this->e;
        $container = ContainerUtility::type(request()->brand, $this->type, $cuuid);
        return $container;
        // return $this->response->json([
        //     'brand' => $container
        // ]);
    }
}
