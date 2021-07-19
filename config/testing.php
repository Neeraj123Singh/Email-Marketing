<?php

/**
 * testing.php
 * 
 * @since 23 Aug, 2020
 * @copyright Grorapid @ 2020
 * @author Manish Sahani <rec.manish.sahani@gmail.com>
 */

use App\User;

return [
    'user' => [
        'fake' => [
            User::SCHEMA_NAME       => 'Manish Sahani',
            User::SCHEMA_FIRST_NAME => 'Manish',
            User::SCHEMA_EMAIL      => 'mani00manu@gmail.com',
            User::SCHEMA_ACTIVE     => 1,
            User::SCHEMA_PASSWORD   => 'password',
            User::PIVOT_ROLE_ID     => 1,
        ],
    ],
];