<?php

/**
 * ApiRegisterTest.php
 * 
 * @since 23 Aug, 2020
 * @copyright Grorapid @ 2020
 * @author Manish Sahani <rec.manish.sahani@gmail.com>
 */

namespace Tests\Unit;

use App\Http\Http;
use App\Models\Brand;
use App\Models\Contact;
use App\User;
use App\Utilities\HelperUtility;
use App\V1Routes;
use Illuminate\Http\Response;
use Tests\TestCase;

class ApiRegisterTest extends TestCase
{
    ///////////////////////////////////////////////////////////////////////////
    //  testApiRegisterExceptionUnprocessableEntry
    ///////////////////////////////////////////////////////////////////////////
    // 
    //  Type            : Expception testing 
    //  Controller      : App\Http\Controllers\auth\RegisterController
    //  FormRequest     : App\Http\Requests\RegisterRequest
    // 
    //  tests the response of the server when unprocessable entry is given in 
    //  the request body, missing fields are:-
    //  - User::SCHEMA_EMAIL
    //  - User::SCHEMA_PASSWORD
    //  - User::SCHEMA_NAME
    //  
    //  ------------------------------ Expected -------------------------------
    // 
    //  statusCode      : Http::RESPONSE_STATUS_CODE_UNPROCESSABLE_ENTRY
    //  status          : Http::RESPONSE_STATUS_ERROR
    //  statusMessage   : Http::RESPONSE_STATUS_ERROR_MESSAGE
    // 
    ///////////////////////////////////////////////////////////////////////////
    public function testApiRegisterExceptionUnprocessableEntry()
    {
        $response = $this->postJson('/api/' . V1Routes::REGISTER, []);

        $response->assertStatus(Http::RESPONSE_STATUS_CODE_UNPROCESSABLE_ENTRY);
        $response->assertJsonPath('status',             Http::RESPONSE_STATUS_ERROR);
        $response->assertJsonPath('statusCode',         Http::RESPONSE_STATUS_CODE_UNPROCESSABLE_ENTRY);
        $response->assertJsonPath('statusMessage',      Http::RESPONSE_STATUS_ERROR_MESSAGE);
        $response->assertJsonPath('details',            Response::$statusTexts[Http::RESPONSE_STATUS_CODE_UNPROCESSABLE_ENTRY]);
        $response->assertJsonPath('response.message',   "The given data was invalid.");

        // assert error message of email field 
        $response->assertJsonPath(
            'response.errors.' . User::SCHEMA_EMAIL . '.0',
            'The ' . User::SCHEMA_EMAIL . ' field is required.'
        );

        // assert error message of password field 
        $response->assertJsonPath(
            'response.errors.' . User::SCHEMA_PASSWORD . '.0',
            'The ' . User::SCHEMA_PASSWORD . ' field is required.'
        );

        // assert error message of password field 
        $response->assertJsonPath(
            'response.errors.' . User::SCHEMA_NAME . '.0',
            'The ' . User::SCHEMA_NAME . ' field is required.'
        );
    }

    
    public function testApiRegisterExceptionWrongMethod()
    {
        $response = $this->get('/api/' . V1Routes::REGISTER);

        $response->assertStatus(Http::RESPONSE_STATUS_CODE_METHOD_NOT_ALLOWED);
        $response->assertJsonPath('status',             Http::RESPONSE_STATUS_ERROR);
        $response->assertJsonPath('statusCode',         Http::RESPONSE_STATUS_CODE_METHOD_NOT_ALLOWED);
        $response->assertJsonPath('statusMessage',      Http::RESPONSE_STATUS_ERROR_MESSAGE);
        $response->assertJsonPath('details',            Response::$statusTexts[Http::RESPONSE_STATUS_CODE_METHOD_NOT_ALLOWED]);
        $response->assertJsonPath('response.message',   "The GET method is not supported for this route. Supported methods: POST.");
    }

    
    public function testApiRegisterExceptionDuplicateEntry()
    {
        $response = $this->postJson('/api/' . V1Routes::REGISTER, config('testing.user.fake'));

        $response->assertStatus(Http::RESPONSE_STATUS_CODE_UNPROCESSABLE_ENTRY);
        $response->assertJsonPath('status',             Http::RESPONSE_STATUS_ERROR);
        $response->assertJsonPath('statusCode',         Http::RESPONSE_STATUS_CODE_UNPROCESSABLE_ENTRY);
        $response->assertJsonPath('statusMessage',      Http::RESPONSE_STATUS_ERROR_MESSAGE);
        $response->assertJsonPath('details',            Response::$statusTexts[Http::RESPONSE_STATUS_CODE_UNPROCESSABLE_ENTRY]);
        $response->assertJsonPath('response.message',   "The given data was invalid.");

        $response->assertJsonPath(
            'response.errors.' . User::SCHEMA_EMAIL . '.0',
            'The ' . User::SCHEMA_EMAIL . ' has already been taken.'
        );
    }

    ///////////////////////////////////////////////////////////////////////////
    //  test Api Register User
    ///////////////////////////////////////////////////////////////////////////
    public function testApiRegisterNewUser()
    {
        $data = self::fake();
        $response = $this->postJson('/api/' . V1Routes::REGISTER, $data);

        $this->basicAssertions($response);
        
        // assert error message of email field 
        $response->assertJsonPath(
            'response.' . User::SCHEMA_EMAIL,
            $data[User::SCHEMA_EMAIL]
        );

        // assert Active or not for the user
        $response->assertJsonPath(
            'response.' . User::SCHEMA_ACTIVE,
            0
        );
    }

    public function testApiRegisteredUserDefaultBrand()
    {
        $data = self::fake();
        $response = $this->postJson('/api/' . V1Routes::REGISTER, $data);

        $this->basicAssertions($response);
        // assert brand's title for the user
        $response->assertJsonPath(
            'response.' . User::RELATION_BRAND . '.title',
            ucfirst(HelperUtility::split_name($data[User::SCHEMA_NAME])[0]) . "'s Brand"
        );
    }

    public function testApiRegisteredUserBrandDefaultAudience()
    {
        $data = self::fake();
        $response = $this->postJson('/api/' . V1Routes::REGISTER, $data);

        $this->basicAssertions($response);
        // assert brand's title for the user
        $response->assertJsonPath(
            'response.' . User::RELATION_BRAND . '.' . Brand::RELATION_AUDIENCE . '.type.name',
            Brand::RELATION_AUDIENCE
        );
    }

    public function testApiRegisteredUserBrandDefaultContact()
    {
        $data = self::fake();
        $response = $this->postJson('/api/' . V1Routes::REGISTER, $data);

        $this->basicAssertions($response);
        // assert brand's title for the user
        $response->assertJsonPath(
            'response.' . User::RELATION_BRAND . '.' . Brand::RELATION_CONTACT . '.email',
            $data[Contact::SCHEMA_EMAIL]
        );
    }

    /**
     * Get Fake Json for the Request Body
     * 
     * @return array
     */
    public static function fake()
    {
        return [
            User::SCHEMA_EMAIL      => HelperUtility::srand() . '@gmail.com',
            User::SCHEMA_PASSWORD   => HelperUtility::srand() . " " . HelperUtility::srand(),
            User::SCHEMA_NAME       => HelperUtility::srand()
        ];
    }
}
