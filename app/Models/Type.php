<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Type extends Model
{
    /*
    |
    |   Type is the 
    |
    */

    use SoftDeletes;

    ///////////////////////////////////////////////////////////////////////////
    //  Type Schema
    ///////////////////////////////////////////////////////////////////////////
    public const SCHEMA_NAME        = 'name';
    public const SCHEMA_MODEL       = 'model';
    public const SCHEMA_SERVICE     = 'service';
    public const SCHEMA_VISIBLE     = 'visible';

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'created_at', 'updated_at', 'deleted_at'
    ];
}
