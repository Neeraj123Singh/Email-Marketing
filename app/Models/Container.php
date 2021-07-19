<?php

namespace App\Models;

use App\Models\Services\Campaign;
use App\Traits\Uuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Log;

class Container extends Model
{
    /*
    |
    |   Container is our way of handling the operations performed on different 
    |   services. Every service when created is wrapped in a container with a
    |   type and some other descriptive elements, that helps us determine the 
    |   whether service is template or executable. 
    | 
    |   Container are what we deliver to the client or any third party app, when
    |   they wishes to use a standalone service (like campaign or form only).
    |
    |   CONTAINERS MUST NOT BE CREATED WITHOUT PROVIDING A TYPE
    |
    */

    use Uuids;
    use SoftDeletes;

    ///////////////////////////////////////////////////////////////////////////
    //  Container Schema
    ///////////////////////////////////////////////////////////////////////////
    public const SCHEMA_VISIBLE         = 'visible';
    public const SCHEMA_TEMPLATE        = 'template';
    public const SCHEMA_PUBLISH         = 'publish';
    public const SCHEMA_PUBLISHED_AT    = 'published_at';

    // Pivoting constants
    public const PIVOT_BRAND_ID         = 'brand_id';
    public const PIVOT_TYPE_ID          = 'type_id';
    public const PIVOT_SERVICE_ID       = 'service_id';
    public const PIVOT_REFERENCE_ID     = 'reference_id';
    public const PIVOT_CONTAINER_ID     = 'container_id';
    public const PIVOT_CONNECTED_ID     = 'connected_id';

    // relationship keys constants 
    public const RELATION_SERVICE       = 'service';
    public const RELATION_TYPE          = 'type';

    /**
     * The attributes that are mass assignable 
     * 
     * @var array 
     */
    protected $fillable = [
        self::SCHEMA_PUBLISH,
        self::SCHEMA_VISIBLE,
        self::SCHEMA_TEMPLATE,
        self::SCHEMA_PUBLISHED_AT,
        self::PIVOT_TYPE_ID,
        self::PIVOT_SERVICE_ID,
    ];

    ///////////////////////////////////////////////////////////////////////////
    //  Container Relationships
    ///////////////////////////////////////////////////////////////////////////

    /**
     * Brand relationship, returns the container's brand instance 
     * 
     * @return \App\Models\Brand
     */
    public function brand()
    {
        return $this->belongsTo(Brand::class, self::PIVOT_BRAND_ID);
    }

    /**
     * Type relationship, returns the container's type instance 
     * 
     * @return \App\Models\Type
     */
    public function type()
    {
        return $this->belongsTo(Type::class, self::PIVOT_TYPE_ID);
    }

    /**
     * Container Service, returns the container's service instance 
     * 
     * @return \App\Models\Service
     */
    public function service()
    {
        return $this->hasOne($this->type->model);
    }

    /**
     * Container reference, returns the container's referenc instance
     * 
     * @return \App\Models\Container
     */
    public function reference()
    {
        return $this->belongsTo(Container::class, self::PIVOT_REFERENCE_ID);
    }

    /**
     * This is the relation to connect two containers basically two services
     * a service can be connected to multiple services via containers using 
     * Many to Many relationships 
     * 
     * - can be used to connect to Campaigns and Audience 
     * 
     * @return \App\Models\Container
     */
    public function connnectedContainers()
    {
        return $this->belongsToMany(
                        Container::class, 
                        'container_container', 
                        self::PIVOT_CONTAINER_ID, 
                        self::PIVOT_CONNECTED_ID
                    )->withTimestamps();
    }
}
