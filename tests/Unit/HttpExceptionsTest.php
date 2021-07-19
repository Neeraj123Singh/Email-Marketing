<?php

/**
 * HttpExceptionsTest.php
 * 
 * @since 23 Aug, 2020
 * @copyright Grorapid @ 2020
 * @author Manish Sahani <rec.manish.sahani@gmail.com>
 */

namespace Tests\Unit;

use App\Http\Http;
use Illuminate\Http\Response;
use Tests\TestCase;

class HttpExceptionsTest extends TestCase
{
    public function testHttpExceptionResponseStructure()
    {
        $response = $this->get('/api/' . rand());

        $response->assertStatus(Http::RESPONSE_STATUS_CODE_NOT_FOUND);
        $response->assertJsonPath('status', Http::RESPONSE_STATUS_ERROR);
        $response->assertJsonPath('statusCode', Http::RESPONSE_STATUS_CODE_NOT_FOUND);
        $response->assertJsonPath('statusMessage', Http::RESPONSE_STATUS_ERROR_MESSAGE);
        $response->assertJsonPath('details', Response::$statusTexts[Http::RESPONSE_STATUS_CODE_NOT_FOUND]);
    }

    public function testHttpExceptionNotFound()
    {
        $response = $this->get('/api/' . rand());

        $response->assertStatus(Http::RESPONSE_STATUS_CODE_NOT_FOUND);
        $response->assertJsonPath('status', Http::RESPONSE_STATUS_ERROR);
        $response->assertJsonPath('statusCode', Http::RESPONSE_STATUS_CODE_NOT_FOUND);
        $response->assertJsonPath('statusMessage', Http::RESPONSE_STATUS_ERROR_MESSAGE);
        $response->assertJsonPath('details', Response::$statusTexts[Http::RESPONSE_STATUS_CODE_NOT_FOUND]);
    }

    public function testHttpExceptionMethodNotAllowed()
    {
        $response = $this->post('/api/');

        $response->assertStatus(Http::RESPONSE_STATUS_CODE_METHOD_NOT_ALLOWED);
        $response->assertJsonPath('status', Http::RESPONSE_STATUS_ERROR);
        $response->assertJsonPath('statusCode', Http::RESPONSE_STATUS_CODE_METHOD_NOT_ALLOWED);
        $response->assertJsonPath('statusMessage', Http::RESPONSE_STATUS_ERROR_MESSAGE);
        $response->assertJsonPath('details', Response::$statusTexts[Http::RESPONSE_STATUS_CODE_METHOD_NOT_ALLOWED]);
    }
}
