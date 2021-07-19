<?php

namespace Tests;

use App\Http\Http;
use App\V1Routes;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use Illuminate\Support\Facades\Log;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;

    public $token;

    public function basicAssertions($response, $code = Http::RESPONSE_STATUS_CODE_CREATED, $status = Http::RESPONSE_STATUS_OK, $message = Http::RESPONSE_STATUS_OK_MESSAGE)
    {
        $response->assertStatus($code);
        $response->assertJsonPath('status',         $status);
        $response->assertJsonPath('statusCode',     $code);
        $response->assertJsonPath('statusMessage',  $message);
    }

    public function apiAssertOk($response)
    {
        $response->assertOk();
        $response->assertJsonPath('status',             Http::RESPONSE_STATUS_OK);
        $response->assertJsonPath('statusCode',         Http::RESPONSE_STATUS_CODE_OK);
        $response->assertJsonPath('statusMessage',      Http::RESPONSE_STATUS_OK_MESSAGE);
    }

    public function getAuthToken()
    {
        $response = $this->postJson('/api/' . V1Routes::LOGIN, self::user());
        $this->apiAssertOk($response);
        $content = $response->decodeResponseJson();
        return $content['response']['token'];
    }

    public static function user()
    {
        return config('testing.user.fake');
    }

    public function authorizedHeaders()
    {
        $token = $this->getAuthToken();

        return [
            'Authorization' => 'Bearer ' . $token,
            'Accept'        => 'application/json'
        ];
    }
}
