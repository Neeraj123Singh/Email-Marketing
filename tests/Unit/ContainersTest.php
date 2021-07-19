<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\V1Routes;
use Illuminate\Support\Facades\Log;
class ContainersTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     * @throws \Throwable
     */
    public function testContainersGet()
    {
        $response = $this->get(V1Routes::API . V1Routes::BRAND_INDEX, $this->authorizedHeaders());
        $content  = $response->decodeResponseJson();
        Log::info($content);
        $this->apiAssertOk($response);
        $buuid = $content['response']['brands'][0]['uuid'];
        $response = $this->get(V1Routes::API . V1Routes::CONTAINERS . '?' . V1Routes::BRAND_ID . '=' . $buuid ,$this->authorizedHeaders());
        $this->apiAssertOk($response);
        Log::info($response->decodeResponseJson());
    }
}
