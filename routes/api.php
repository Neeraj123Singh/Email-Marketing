<?php

use App\Http\Controllers\auth\LoginController;
use App\Http\Controllers\auth\RegisterController;
use App\Http\Controllers\V1\AudienceController;
use App\Http\Controllers\V1\BrandController;
use App\Http\Controllers\V1\ContainerController;
use App\Http\Controllers\V1\HomeController;
use App\Http\Controllers\CampaignController;
use App\V1Routes;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::get(V1Routes::HOME, HomeController::class . '@handle');
Route::post(V1Routes::REGISTER, RegisterController::class . '@handle');
Route::post(V1Routes::LOGIN, LoginController::class . '@handle');

Route::middleware(['auth:api', 'role:admin|user'])->group(function () {
    Route::get('home', HomeController::class . '@home');

    ///////////////////////////////////////////////////////////////////////////
    //  BRAND ROUTES
    ///////////////////////////////////////////////////////////////////////////
    Route::get(V1Routes::BRAND_INDEX, BrandController::class . '@index');
    Route::post(V1Routes::BRAND_CREATE, BrandController::class . '@create');
    Route::get(V1Routes::BRAND_GET, BrandController::class . '@get');

    Route::middleware(['brand'])->group(function () {

        ///////////////////////////////////////////////////////////////////////////
        //  CONTAINER ROUTES
        ///////////////////////////////////////////////////////////////////////////
        Route::get(V1Routes::CONTAINERS, ContainerController::class . '@index');
        Route::get(V1Routes::CONTAINERS_TYPE, ContainerController::class . '@type');
        Route::post(V1Routes::CONTAINERS, ContainerController::class . '@create');

        Route::prefix(V1Routes::PREFIX_CONTAINER)->group(function () {

            Route::get(V1Routes::CONTAINER_GET, ContainerController::class . '@get');
            Route::post(V1Routes::CONTAINER_SYNC, ContainerController::class . '@sync');
            Route::get(V1Routes::CONTAINER_CONNECTED, ContainerController::class . '@connected');
            Route::post(V1Routes::CONTAINER_ACTIVATE, ContainerController::class . '@activate');
        });

        Route::prefix(V1Routes::PREFIX_AUDIENCE)->group(function () {
            Route::get(V1Routes::AUDIENCE_GET, AudienceController::class . '@get');
        });

        Route::prefix(V1Routes::PREFIX_CAMPAIGN)->group(function () {
            Route::put(V1Routes::CAMPAIGN_UPDATE, CampaignController::class . '@update');
        });

        //TODO
        //CAMPAIGN
    });
});
