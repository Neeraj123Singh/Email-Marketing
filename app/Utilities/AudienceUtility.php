<?php

/**
 * AudienceUtility.php
 *
 * @since 27 Aug, 2020
 * @copyright Grorapid @ 2020
 * @author Manish Sahani <rec.manish.sahani@gmail.com>
 */

namespace App\Utilities;

use App\Models\Audience;
use App\Models\Brand;
use App\Models\Contact;
use App\Models\Container;
use Illuminate\Support\Facades\DB;

class AudienceUtility
{
    ///////////////////////////////////////////////////////////////////////////
    //  Audience Utility
    ///////////////////////////////////////////////////////////////////////////
    //
    //  The utility is responsible for handling all brand's audience related
    //  queries.
    //
    ///////////////////////////////////////////////////////////////////////////

    /**
     * Create a brand new audience
     *
     * @param  \App\Models\Containers $container
     * @param  array $data
     * @return \App\Models\Audience
     */
    public static function create(Container $container, array $data = [])
    {
        return DB::transaction(function () use ($container, $data) {
            return self::build(Audience::create(self::prepare($container, $data)), $data);
        });
    }



    /**
     * Build a Audience, attach all the necessay services and subscription with
     * the audience
     *
     * @param \App\Models\Audience
     * @param array $data
     * @return \App\Models\Audience
     */
    public static function build(Audience $audience, array $data = [])
    {
        // Create a default contact in the Audience
        // $contacts = ContactUtility::create($audience->container->brand, self::defaultContactData($audience));
        // $audience[Audience::RELATION_CONTACT] = self::sync($contacts, [$audience->id]);
        return $audience;
    }

    public static function sync(Contact $contact, array $audience_ids = [])
    {
        return $contact->audience()->syncWithoutDetaching($audience_ids);
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
    public static function prepare(Container $container, array $data)
    {
        return [
            Audience::PIVOT_CONTAINER_ID    => $container->id,
            Audience::SCHEMA_TITLE          => HelperUtility::keyVal($data, Audience::SCHEMA_TITLE),
            Audience::SCHEMA_DESCRIPTION    => HelperUtility::keyVal($data, Audience::SCHEMA_DESCRIPTION),
        ];
    }
}
