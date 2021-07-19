<?php

/**
 * CampaignService.php
 *
 * @since 27 Aug, 2020
 * @copyright Grorapid @ 2020
 * @author Manish Sahani <rec.manish.sahani@gmail.com>
 */

namespace App\Services;

use App\Jobs\ActivateCampaign;
use App\Jobs\Services\CampaignJob;
use App\Models\Container;
use App\Models\Services\Campaign;
use App\Utilities\AudienceUtility;
use App\Utilities\ContainerUtility;
use App\Utilities\HelperUtility;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class CampaignService
{
    ///////////////////////////////////////////////////////////////////////////
    //  Campaign Service
    ///////////////////////////////////////////////////////////////////////////
    //
    //  The utility is responsible for handling all the brand's campaign
    //  related queries.
    //
    ///////////////////////////////////////////////////////////////////////////

    /**
     * Create a brand new campaign
     *
     * @param \App\Models\Brand $brand
     * @param array $data
     * @return \App\Models\Services\Campaign
     */
    public static function create(Container $container, $data)
    {
        return DB::transaction(function () use ($container, $data) {
            return self::build(Campaign::create(self::prepare($container, $data)), $data);
        });
    }

    /**
     * Find the user with
     *
     * @param string $value
     * @param string $where
     */
    public function find($value, $where = 'id', $with = [])
    {
        // return User::where($where, $value)->with($with)->firstOrFail();
    }

    public static function update(Container $container, $data)
    {
        $container->service->update($data);
        return $container->service;
    }

    /**
     * Activate the Service, update the related container status
     *
     * @param \App\Models\Container $container
     * @param array $data
     * @return mixed
     */
    public static function activate(Container $container, array $data)
    {
//        return DB::transaction(function () use ($container, $data) {
//            $audiences = $container->connnectedContainers()->get(['id']);
//            foreach ($audiences as $audience) {
//                Log::info('hello');
//                $c = ContainerUtility::find($container->brand, $audience->id, 'id', []);
//                Log::info($c);
//                Log::info($c->service);
//            }
        dispatch(new ActivateCampaign($container, $data));
    }


    ///////////////////////////////////////////////////////////////////////////
    //  Utility Specific Functions
    ///////////////////////////////////////////////////////////////////////////

    /**
     * Build the User, attach all the necessary services and subscriptions to
     * the user
     *
     * @param \App\User
     */
    public static function build($campaign, array $data)
    {
        return $campaign;
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
            Campaign::PIVOT_CONTAINER_ID => $container->id,
            Campaign::PIVOT_BRAND_ID => $container->brand->id,
            Campaign::SCHEMA_TITLE => HelperUtility::keyVal($data, Campaign::SCHEMA_TITLE, " "),
            Campaign::SCHEMA_SUBJECT => HelperUtility::keyVal($data, Campaign::SCHEMA_SUBJECT, " "),
            Campaign::SCHEMA_SLUG => Str::slug(HelperUtility::keyVal($data, Campaign::SCHEMA_TITLE, " "), "-"),
            Campaign::SCHEMA_FROM_NAME => HelperUtility::keyVal($data, Campaign::SCHEMA_FROM_NAME),
            Campaign::SCHEMA_FROM_EMAIL => HelperUtility::keyVal($data, Campaign::SCHEMA_FROM_EMAIL),
            Campaign::SCHEMA_REPLY_TO => HelperUtility::keyVal($data, Campaign::SCHEMA_REPLY_TO),
            Campaign::SCHEMA_DESCRIPTION => HelperUtility::keyVal($data, Campaign::SCHEMA_DESCRIPTION),
            Campaign::SCHEMA_CONTENT => HelperUtility::keyVal($data, Campaign::SCHEMA_CONTENT),
            Campaign::SCHEMA_CONTENT_JSON => HelperUtility::keyVal($data, Campaign::SCHEMA_CONTENT_JSON),
            Campaign::SCHEMA_TEXT => HelperUtility::keyVal($data, Campaign::SCHEMA_TEXT),
            Campaign::SCHEMA_TEXT_ONLY => HelperUtility::keyVal($data, Campaign::SCHEMA_TEXT_ONLY, 0),
        ];
    }
}
