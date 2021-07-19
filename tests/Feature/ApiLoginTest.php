<?php

/**
 * ApiLoginTest.php
 * 
 * @since 23 Aug, 2020
 * @copyright Grorapid @ 2020
 * @author Manish Sahani <rec.manish.sahani@gmail.com>
 */


namespace Tests\Feature;

use Tests\TestCase;

class ApiLoginTest extends TestCase
{
    public function testApiLogin()
    {
        $token = $this->getAuthToken();
        $this->assertNotNull($token);
    }
}
