<?php

namespace App\Http\Controllers;

use App\Models\Services\Campaign;
use App\Utilities\ContainerUtility;
use Illuminate\Http\Request;

class CampaignController extends Controller
{
    public function update(Request $request, $cuuid)
    {
        $container = ContainerUtility::firstOrFail($request->brand, $cuuid);
        return $this->response->json([
            "campaign" => $container->type->service::update($container, $request->all())
        ]);
    }
}
