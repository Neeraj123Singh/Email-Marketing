<?php

/**
 * ContainerUtility.php
 *
 * @since 25 Aug, 2020
 * @copyright Grorapid @ 2020
 * @author Manish Sahani <rec.manish.sahani@gmail.com>
 */

namespace App\Utilities;

use App\Models\Brand;
use App\Models\Container;
use App\Models\Type;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class ContainerUtility
{
    ///////////////////////////////////////////////////////////////////////////
    //  Container Utility
    ///////////////////////////////////////////////////////////////////////////
    //
    //  The utility is responsible for handling all the brand's container related
    //  queries.
    //
    ///////////////////////////////////////////////////////////////////////////

    /**
     * Create a new container for a specific brand
     *
     * @param  \App\Models\Brand    $brand
     * @param  array                $data
     * @return \App\Models\Container
     */
    public static function create(Brand $brand, Type $type, $data = [])
    {
        return DB::transaction(function () use ($brand, $type, $data) {
            return self::build($brand->containers()->create(self::prepare($brand, $type, $data)), $data);
        });
    }

    /**
     * Find all container for a brand
     *
     * @param  \App\Models\Brand $brand
     * @return array
     */
    public static function all(Brand $brand, $where = [])
    {
        return $brand->containers()->with([Container::RELATION_TYPE])->get();
    }

    /**
     * Find a specific brand for a user
     *
     * @param  \App\Models\Brand $brand
     * @param  mixed             $value
     * @param  string            $where
     * @param  mixed             $with
     * @return \App\Models\Container
     */
    public static function find(Brand $brand, $value, $where = 'uuid', $with = [Container::RELATION_TYPE])
    {
        return DB::transaction(function () use ($brand, $value, $where, $with) {

            $container = $brand->containers()->where($where, $value)->with($with)->first();
            // Update the container with the related service using a dynamic resolution method
            // that determines the Container service type and find the service with containe_id
            // equals to the this container_id
            $container[Container::RELATION_SERVICE] = $container->service;

            return $container;
        });
    }

    /**
     * Find a specific brand for a user with an array of conditions
     *
     * @param  \App\Models\Brand $brand
     * @param  array             $where
     * @param  array             $with
     * @return \App\Models\Container
     */
    public static function where(Brand $brand, $where, $with = [Container::RELATION_TYPE])
    {
        return $brand->containers()->where($where)->with($with)->first();
    }

    /**
     * Find a specific brand for a user
     *
     * @param  \App\Models\Brand $brand
     * @param  mixed             $value
     * @param  string            $where
     * @param  mixed             $with
     * @return \App\Models\Container
     */
    public static function firstOrFail(Brand $brand, $value, $where = 'uuid', $with = [Container::RELATION_TYPE])
    {
        return $brand->containers()->where($where, $value)->with($with)->firstOrFail();
    }

    /**
     * Activate the Container, handles the validation here and activate the
     * service
     *
     * @param  \App\Models\Container $container
     * @param  array $data
     * @return mixed
     */
    public static function activate(Container $container, array $data)
    {
        return DB::transaction(function () use ($container, $data) {
            // Validate the user's subscription

            // Update the subscription and decrement the user's service remaining count

            // Validate the prerequiste before activating the service

            // active the service with the given data
            return $container->type[Type::SCHEMA_SERVICE]::activate($container, $data);
        });
    }

    /**
     * Sync container with other containers, using laravel's sync
     *
     * @param  \App\Models\Container $container
     * @param  array $data
     */
    public static function sync(Container $container, $container_ids = [])
    {
        return $container->connnectedContainers()->syncWithoutDetaching($container_ids);
    }

    /**
     * Get a container's connected containers
     *
     * @param  \App\Models\Container $container
     * @param  array $data
     */
    public static function connected(Container $container)
    {
        return $container->connnectedContainers()->with([Container::RELATION_TYPE])->get();
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
    public static function build(Container $container, array $data)
    {
        $service   = $container->type[Type::SCHEMA_SERVICE]::create($container, $data);
        $container->update([Container::PIVOT_SERVICE_ID => $service->id]);

        return $container;
    }

    ///////////////////////////////////////////////////////////////////////////
    //  Utility Helper Functions
    ///////////////////////////////////////////////////////////////////////////

    /**
     * Process and prepare the data for the creation of a new User
     *
     * @param \App\User $user
     * @param array $data
     * @return array
     */
    public static function prepare(Brand $brand, Type $type, array $data)
    {
        return [
            Container::SCHEMA_VISIBLE       => HelperUtility::keyVal($data, Container::SCHEMA_VISIBLE, 1),
            Container::SCHEMA_TEMPLATE      => HelperUtility::keyVal($data, Container::SCHEMA_TEMPLATE, 0),
            Container::PIVOT_TYPE_ID        => $type->id,
        ];
    }
}
