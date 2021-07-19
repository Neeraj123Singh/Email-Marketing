<?php

/**
 * Role.php
 * 
 * @since 23 Aug, 2020
 * @copyright Grorapid @ 2020
 * @author Manish Sahani <rec.manish.sahani@gmail.com>
 */

namespace App\Models;

use Laratrust\Models\LaratrustRole;

class Role extends LaratrustRole
{
    public $guarded = [];

    ///////////////////////////////////////////////////////////////////////////
    //  Role Schema
    ///////////////////////////////////////////////////////////////////////////
    public const SCHEMA_NAME         = 'name';
    public const SCHEMA_DISPLAY_NAME = 'display_name';
    public const SCHEMA_DESCRIPTION  = 'description';
}
