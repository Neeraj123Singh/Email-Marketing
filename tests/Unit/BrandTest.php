<?php

namespace Tests\Unit;

use App\V1Routes;
use Illuminate\Support\Facades\Log;
use Tests\TestCase;

class BrandTest extends TestCase
{
    public function testApiBrandIndex()
    {
        $response = $this->get('/api/' . V1Routes::BRAND_INDEX, $this->authorizedHeaders());
        $content  = $response->decodeResponseJson();

        $this->apiAssertOk($response);
        $this->assertNotEmpty($content['response']['brands']);
        $this->assertNotNull($content['response']['brands'][0]['title']);
    }

    // public function testApiBrandCreate()
    // {
    //     $response = $this->postJson('/api/' . V1Routes::BRAND_INDEX, $this->authorizedHeaders());
    // }

    public function testApiBrandGet()
    {
        $response = $this->get('/api/' . V1Routes::BRAND_INDEX, $this->authorizedHeaders());
        $content  = $response->decodeResponseJson();
        $this->apiAssertOk($response);

        $response = $this->get('/api/brand/' . $content['response']['brands'][0]['uuid'] , $this->authorizedHeaders());
        $content  = $response->decodeResponseJson();
        $this->apiAssertOk($response);
        $this->assertNotEmpty($content['response']);
        $this->assertNotNull($content['response']['brand']['title']);
    }
}
