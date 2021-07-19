<?php

/**
 * seeder.php
 * 
 * @since 27 Aug, 2020
 * @copyright Grorapid @ 2020
 * @author Manish Sahani <rec.manish.sahani@gmail.com>
 */

use App\Models\Audience;
use App\Models\Services\Campaign;
use App\Models\Type;

return [
    'types' => [
        [
            Type::SCHEMA_NAME       => Campaign::SERVICE_NAME, 
            Type::SCHEMA_MODEL      => Campaign::class, 
            Type::SCHEMA_SERVICE    => Campaign::SERVICE,
            Type::SCHEMA_VISIBLE    => 1
        ], 
        [
            Type::SCHEMA_NAME       => Audience::SERVICE_NAME, 
            Type::SCHEMA_MODEL      => Audience::class, 
            Type::SCHEMA_SERVICE    => Audience::SERVICE,
            Type::SCHEMA_VISIBLE    => 1
        ], 
    ],
];