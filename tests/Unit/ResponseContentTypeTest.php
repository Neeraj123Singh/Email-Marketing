<?php
/**
 * ResponseContentTypeTest.php
 * 
 * @since 23 Aug, 2020
 * @copyright Grorapid @ 2020
 * @author Manish Sahani <rec.manish.sahani@gmail.com>
 */

namespace Tests\Unit;

use App\Http\Http;
use Illuminate\Http\Response;
use Tests\TestCase;

class ResponseContentTypeTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function testResponseContentType()
    {
        $response = $this->get('/api/');

        $response->assertOk();
        $response->assertJsonPath('status', Http::RESPONSE_STATUS_OK);
        $response->assertJsonPath('statusCode', Http::RESPONSE_STATUS_CODE_OK);
        $response->assertJsonPath('statusMessage', Http::RESPONSE_STATUS_OK_MESSAGE);
        $response->assertJsonPath('details', Response::$statusTexts[Http::RESPONSE_STATUS_CODE_OK]);
        $response->assertJsonPath('response', config('message.welcome'));

        $this->assertEquals(Http::RESPONSE_CONTENT_TYPE, $response->headers->get('Content-Type'));
    }
}
