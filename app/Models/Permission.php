<?php

namespace App\Models;

use Laratrust\Models\LaratrustPermission;

class Permission extends LaratrustPermission
{
    public $guarded = [];

    ///////////////////////////////////////////////////////////////////////////
    //  Role Schema
    ///////////////////////////////////////////////////////////////////////////
    public const SCHEMA_NAME         = 'name';
    public const SCHEMA_DISPLAY_NAME = 'display_name';
    public const SCHEMA_DESCRIPTION  = 'description';
}
