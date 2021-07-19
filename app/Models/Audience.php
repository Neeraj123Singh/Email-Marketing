<?php

namespace App\Models;

use App\Traits\Uuids;
use App\Utilities\AudienceUtility;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Audience extends Model
{
    use Uuids;
    use SoftDeletes;

    ///////////////////////////////////////////////////////////////////////////
    //  Audience Schema
    ///////////////////////////////////////////////////////////////////////////
    public const SCHEMA_TITLE       = 'title';
    public const SCHEMA_DESCRIPTION = 'description';
    public const SCHEMA_HIDDEN      = 'hidden';

    // pivoting constants 
    public const PIVOT_CONTAINER_ID = 'container_id';
    public const PIVOT_CONTACT_ID   = 'contact_id';

    // relationship keys constants 
    public const RELATION_CONTACT   = 'contact';

    ///////////////////////////////////////////////////////////////////////////
    //  Service info
    ///////////////////////////////////////////////////////////////////////////
    public const SERVICE            = AudienceUtility::class;
    public const SERVICE_NAME       = 'audience';

    /**
     * The attributes that are mass assignable 
     * 
     * @var array 
     */
    protected $fillable = [
        self::SCHEMA_TITLE,
        self::SCHEMA_DESCRIPTION,
        self::PIVOT_CONTAINER_ID,

    ];

    ///////////////////////////////////////////////////////////////////////////
    //  Audience Relationships
    ///////////////////////////////////////////////////////////////////////////
    
    /**
     * Contact relationship, returns the audience's contact instance 
     * 
     * @return \App\Models\Contact
     */
    public function contacts()
    {
        return $this->belongsToMany(Contact::class, Contact::PIVOT_AUDIENCE_ID);
    }

    /**
     * Container relationship, returns the audience's container instance 
     * 
     * @return \App\Models\Container
     */
    public function container()
    {
        return $this->belongsTo(Container::class, self::PIVOT_CONTAINER_ID);
    }
}
