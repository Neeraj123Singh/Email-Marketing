<?php

/**
 * BrandUtility.php
 * 
 * @since 25 Aug, 2020
 * @copyright Grorapid @ 2020
 * @author Manish Sahani <rec.manish.sahani@gmail.com>
 */

namespace App\Utilities;

use App\Models\Audience;
use App\Models\Brand;
use App\Models\Contact;
use App\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class BrandUtility
{
    ///////////////////////////////////////////////////////////////////////////
    //  Brand Utility
    ///////////////////////////////////////////////////////////////////////////
    // 
    //  The utility is responsible for handling all the user's brand related 
    //  queries.
    // 
    ///////////////////////////////////////////////////////////////////////////

    /**
     * Create a new brand for a specific user
     * 
     * @param \App\User $user
     * @param array $data 
     * @return \App\Models\Brand
     */
    public static function create(User $user, $data = [])
    {
        return DB::transaction(function () use ($user, $data) {
            return self::build($user->brands()->create(self::prepare($user, $data)), $data);
        });
    }

    /**
     * Find a specific brand for a user
     * 
     * @param \App\User $user
     * @param mixed $value
     * @param string $where
     * @param mixed $with
     * @return \App\Models\Brand
     */
    public static function find(User $user, $value, $where = 'uuid', $with = [])
    {
        return $user->brands()->where($where, $value)->with($with)->first();
    }

    /**
     * Find a specific brand for a user, if not found fail the request 
     * 
     * @param  \App\User $user
     * @param  mixed $value
     * @param  string $where
     * @param  mixed $with
     * @return \App\Models\Brand
     */
    public static function firstOrFail(User $user, $value, $where = 'uuid', $with = [])
    {
        return $user->brands()->where($where, $value)->with($with)->firstOrFail();
    }

    ///////////////////////////////////////////////////////////////////////////
    //  Utility Specific Functions 
    ///////////////////////////////////////////////////////////////////////////

    /**
     * Build a brand, attach all the necessay services and subscription with 
     * the brand 
     * 
     * @param \App\Models\Brand
     * @param array $data
     * @return \App\Models\Brand
     */
    public static function build(Brand $brand, array $data)
    {
        // Create a container with type as audience for default list
        $brand[Brand::RELATION_AUDIENCE] = ContainerUtility::create(
            $brand, 
            TypeUtility::firstOrFail(Audience::SERVICE_NAME),
            [
                Audience::SCHEMA_TITLE => $brand[Brand::SCHEMA_TITLE] . " - All Contacts"
            ]
        );

        // Create a default Contact for the brand 
        $brand[Brand::RELATION_CONTACT] = ContactUtility::create($brand, BrandUtility::defaultContactData($brand));

        return $brand;
    }

    ///////////////////////////////////////////////////////////////////////////
    //  Utility Helper Functions 
    ///////////////////////////////////////////////////////////////////////////

    /**
     * Process and prepare the data for the creation of a new User
     * 
     * @param  \App\User $user
     * @param  array $data
     * @return array 
     */
    public static function prepare(User $user, array $data)
    {
        $title = HelperUtility::keyVal($data, Brand::SCHEMA_TITLE, "Default Brand");

        return [
            Brand::SCHEMA_TITLE     => $title,
            Brand::SCHEMA_SLUG      => Str::slug($title, '-'),
            Brand::PIVOT_CREATED_BY => $user->id,
            Brand::PIVOT_UPDATED_BY => $user->id,
        ];
    }

    /**
     * Returns the default contact for the audience 
     * 
     * @param \App\Models\Audience $audience
     * @return array 
     */
    public static function defaultContactData(Brand $brand)
    {
        return [
            Contact::SCHEMA_EMAIL        => $brand->owner[User::SCHEMA_EMAIL],
            Contact::SCHEMA_FIRST_NAME   => $brand->owner[User::SCHEMA_FIRST_NAME],
            Contact::SCHEMA_LAST_NAME    => $brand->owner[User::SCHEMA_LAST_NAME],
        ];
    }
}
