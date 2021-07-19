<?php

namespace App\Http\Controllers\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\ContainerRequest;
use App\Models\Container;
use App\Utilities\ContainerUtility;
use App\Utilities\TypeUtility;

class ContainerController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | ContainerController  
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling brand's container relatted 
    | requests and uses BrandUtility.
    |
    */

    /**
     * Handle a request to get all containers of a brand.
     *
     * @api GET /api/containers/
     * @see {collection doc link}
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        return $this->response->json([
            "containers" => ContainerUtility::all(request()->brand)
        ]);
    }

    /**
     * Handle a request to get all containers of a brand.
     *
     * @api GET /api/containers/{type}
     * @see {collection doc link}
     * @return \Illuminate\Http\JsonResponse
     */
    public function type($type)
    {
        return $this->response->json([
            "containers" => ContainerUtility::all(
                request()->brand,
                [
                    Container::PIVOT_TYPE_ID => TypeUtility::firstOrFail($type)->id,
                ]
            )
        ]);
    }

    /**
     * Handle a request to create a new brand's container.
     *
     * @api POST /api/containers/
     * @see {collection doc link}
     * @param \App\Http\Requests\ContainerRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function create(ContainerRequest $request)
    {
        return $this->response->json([
            'container' => ContainerUtility::create($request->brand, $request->type, $request->all()),
        ]);
    }

    /**
     * Handle a request to get a specific collection.
     *
     * @api GET /api/container/{cuuid}
     * @see {collection doc link}
     * @return \Illuminate\Http\JsonResponse
     */
    public function get($cuuid)
    {
        $container = ContainerUtility::firstOrFail(request()->brand, $cuuid);
        $container[Container::RELATION_SERVICE] = $container->service;

        return $this->response->json([
            "container" => $container,
        ]);
    }

    /**
     * Handle a request to sync a specific collection.
     *
     * @api POST /api/container/{cuuid}/sync
     * @see {collection doc link}
     * @return \Illuminate\Http\JsonResponse
     */
    public function sync($cuuid)
    {
        $container = ContainerUtility::firstOrFail(request()->brand, $cuuid);

        return $this->response->json([
            "sync" => ContainerUtility::sync($container, request()->container_ids)
        ]);
    }

    /**
     * Handle a request to get connected containers of a specific container.
     *
     * @api GET /api/container/{cuuid}/connected
     * @see {collection doc link}
     * @return \Illuminate\Http\JsonResponse
     */
    public function connected($cuuid)
    {
        return $this->response->json([
            "connected" => ContainerUtility::connected(
                ContainerUtility::firstOrFail(request()->brand, $cuuid)
            )
        ]);
    }

    /**
     * Handle a request to activate a containers.
     *
     * @api POST /api/container/{cuuid}/activate
     * @see {collection doc link}
     * @return \Illuminate\Http\JsonResponse
     */
    public function activate($cuuid)
    {
        return $this->response->json([
            "activate" => ContainerUtility::activate(
                ContainerUtility::firstOrFail(request()->brand, $cuuid),
                request()->all()
            )
        ]);
    }
}
