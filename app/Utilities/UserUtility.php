<?php

/**
 * UserUtility.php
 * 
 * @since 23 Aug, 2020
 * @copyright Grorapid @ 2020
 * @author Manish Sahani <rec.manish.sahani@gmail.com>
 */

namespace App\Utilities;

use App\Mail\RegistrationMail;
use App\Models\Brand;
use App\User;
use Illuminate\Mail\Mailable;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class UserUtility
{
    ///////////////////////////////////////////////////////////////////////////
    //  User Utility
    ///////////////////////////////////////////////////////////////////////////
    // 
    //  The utility is responsible for handling all the user related queries.
    // 
    ///////////////////////////////////////////////////////////////////////////

    /**
     * Create a brand new User with role, team, and subscriptions
     * 
     * @param array $data
     * @return \App\User
     */
    public static function create($data)
    {
        return DB::transaction(function () use ($data) {
            return self::build(User::create(self::prepare($data)), $data);
        });
    }

    /**
     * Find the user with 
     * 
     * @param string $value
     * @param string $where
     * @return \App\User
     */
    public static function find($value, $where = 'id', $with = [])
    {
        return User::where($where, $value)->with($with)->firstOrFail();
    }

    /**
     * Build the User, attach all the necessary services and subscriptions to 
     * the user
     * 
     * @param \App\User
     * @param array $data
     * @return \App\User
     */
    public static function build(User $user, array $data)
    {
        // Attach a role to the user, with the pre-created permissions, if the 
        // role is not specified then the default Role is used.
        $user->attachRole(HelperUtility::keyVal($data, User::PIVOT_ROLE_ID, 3));

        // Create a default brand for the user, everything is binded to this 
        // brand, therefore this should be the first thing to create while 
        // building the user.
        $user[User::RELATION_BRAND] = BrandUtility::create($user, [
            Brand::SCHEMA_TITLE => $user[User::SCHEMA_FIRST_NAME] . '\'s Brand',
        ]);

        // Send a welcome mail to the user, only after brand is created and 
        // also needs to send the verification mail to the user.
        self::mail($user, RegistrationMail::class);

        // At this point, this user has a default brand {User's brand} and this
        // brand has default audience {User's brand's all contact} and a default
        // contact.
        return $user;
    }

    /**
     * Send a mail to the user 
     * 
     * @param \App\User $user
     * @param Mailable $mailable
     * @param array $data
     */
    public static function mail(User $user, $mailable, array $data = [])
    {
        return Mail::to($user->email)->send(new $mailable($user, $data));
    }

    ///////////////////////////////////////////////////////////////////////////
    //  Utility Helper Functions 
    ///////////////////////////////////////////////////////////////////////////
    
    /**
     * Process and prepare the data for the creation of a new User
     * 
     * @param array $data
     * @return array 
     */
    public static function prepare(array $data)
    {
        $first_name = HelperUtility::keyVal($data, User::SCHEMA_FIRST_NAME);
        $last_name  = HelperUtility::keyVal($data, User::SCHEMA_LAST_NAME, "");

        return [
            User::SCHEMA_EMAIL      => HelperUtility::keyVal($data, User::SCHEMA_EMAIL),
            User::SCHEMA_FIRST_NAME => $first_name,
            User::SCHEMA_LAST_NAME  => $last_name,
            User::SCHEMA_PASSWORD   => Hash::make($data[User::SCHEMA_PASSWORD]),
            User::SCHEMA_USERNAME   => Str::slug(trim($first_name) . ' ' . trim($last_name)),
            User::SCHEMA_ACTIVE     => HelperUtility::keyVal($data, User::SCHEMA_ACTIVE, 0)
        ];
    }
}
