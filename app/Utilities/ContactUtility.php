<?php

/**
 * ContactUtility.php
 * 
 * @since 27 Aug, 2020
 * @copyright Grorapid @ 2020
 * @author Manish Sahani <rec.manish.sahani@gmail.com>
 */

namespace App\Utilities;

use App\Models\Audience;
use App\Models\Brand;
use App\Models\Contact;
use Illuminate\Support\Facades\DB;

class ContactUtility
{
    ///////////////////////////////////////////////////////////////////////////
    //  Contact Utility
    ///////////////////////////////////////////////////////////////////////////
    // 
    //  The utility is responsible for handling all audience's contact related 
    //  queries.
    // 
    ///////////////////////////////////////////////////////////////////////////

    /**
     * Create a contact for the brand 
     * 
     * @param \App\Models\Brand $brand
     * @param array $data
     * @return \App\Models\Contact
     */
    public static function create(Brand $brand, array $data = [])
    {
        return DB::transaction(function () use ($brand, $data) {
            return self::build($brand->contacts()->create(self::prepare($data)), $data);
        });
    }

    /**
     * Build a Contact, attach all the necessay services and subscription with 
     * the audience
     * 
     * @param \App\Models\Contact
     * @param array $data
     * @return \App\Models\Contact
     */
    public static function build(Contact $contact, array $data = [])
    {
        // when a contact is created, it is automatically pushed to the brand's 
        // default audience list.
    
        // Brand's default audience list container
        $defaultAudienceContaier = ContainerUtility::where($contact->brand, [
            ['type_id', '=', TypeUtility::firstOrFail(Audience::SERVICE_NAME)->id]
        ]);
        // push the contact in the brand's default list
        AudienceUtility::sync($contact, [$defaultAudienceContaier->service->id]);

        return $contact;
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
        return $data;
    }
}