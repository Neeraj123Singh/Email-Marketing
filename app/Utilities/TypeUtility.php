<?php

/**
 * TypeUtility.php
 * 
 * @since 29 Aug, 2020
 * @copyright Grorapid @ 2020
 * @author Manish Sahani <rec.manish.sahani@gmail.com>
 */

namespace App\Utilities;

use App\Models\Audience;
use App\Models\Type;
use App\User;
use Illuminate\Support\Facades\DB;

class TypeUtility
{
    ///////////////////////////////////////////////////////////////////////////
    //  Type Utility
    ///////////////////////////////////////////////////////////////////////////
    // 
    //  The utility is responsible for handling all the container's type related 
    //  queries.
    // 
    ///////////////////////////////////////////////////////////////////////////

    /**
     * Create a new type for the platform
     * 
     * @param  array                $data 
     * @return \App\Models\Container 
     */
    public static function create($data = [])
    {
        return DB::transaction(function () use ($data) {
            return Type::create($data);
        });
    }

    /**
     * Find a specific type for a container, if not found fail the request 
     * 
     * @param mixed $value
     * @param string $where
     * @param mixed $with
     * @return \App\Models\Type
     */
    public static function firstOrFail($value, $where = Type::SCHEMA_NAME, $with = [])
    {
        return Type::where($where, $value)->with($with)->firstOrFail();
    }
}