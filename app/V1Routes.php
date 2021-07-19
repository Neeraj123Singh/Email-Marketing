<?php

/**
 * V1Routes.php
 *
 * @since 23 Aug, 2020
 * @copyright Grorapid @ 2020
 * @author Manish Sahani <rec.manish.sahani@gmail.com>
 */

namespace App;

class V1Routes
{
    ///////////////////////////////////////////////////////////////////////////
    //  V1Routes
    ///////////////////////////////////////////////////////////////////////////
    //
    //  This is the collection of routes used across the app.
    //
    ///////////////////////////////////////////////////////////////////////////

    public const HOME = '/';
    public const REGISTER = 'register';
    public const LOGIN = 'login';
    public const API = '/api/';

    public const BRANDS = 'brands';
    public const BRAND_INDEX = self::BRANDS;
    public const BRAND_CREATE = self::BRANDS;
    public const PREFIX_BRAND = 'brand';
    public const BRAND_GET = 'brand/{uuid}';
    public const BRAND_ID = 'buuid';

    public const CONTAINERS = 'containers';
    public const CONTAINERS_TYPE = self::CONTAINERS . '/{type}';
    public const PREFIX_CONTAINER = 'container/{cuuid}';
    public const CONTAINER_GET = '/';
    public const CONTAINER_SYNC = 'sync';
    public const CONTAINER_CONNECTED = 'connected';
    public const CONTAINER_ACTIVATE = 'activate';

    public const PREFIX_AUDIENCE = 'audiences/';
    public const AUDIENCE_GET = '{uuid}';

    public const PREFIX_CAMPAIGN = 'campaign';
    public const CAMPAIGN_UPDATE = '/{cuuid}';

}
