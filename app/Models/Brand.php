<?php

namespace App\Models;

use App\Traits\Uuids;
use App\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Brand extends Model
{
    use Uuids;
    use SoftDeletes;

    ///////////////////////////////////////////////////////////////////////////
    //  Brand Schema
    ///////////////////////////////////////////////////////////////////////////
    public const SCHEMA_TITLE       = 'title';
    public const SCHEMA_SLUG        = 'slug';

    // Pivoting constants 
    public const PIVOT_OWNER_ID     = 'owner_id';
    public const PIVOT_CREATED_BY   = 'created_by';
    public const PIVOT_UPDATED_BY   = 'updated_by';

    // relationship keys constants 
    public const RELATION_AUDIENCE  = 'audience';
    public const RELATION_CONTACT   = 'contact';

    /**
     * The attributes that are mass assignable 
     * 
     * @var array 
     */
    protected $fillable = [
        self::SCHEMA_TITLE,
        self::SCHEMA_SLUG,
        self::PIVOT_OWNER_ID,
        self::PIVOT_CREATED_BY,
        self::PIVOT_UPDATED_BY
    ];

    ///////////////////////////////////////////////////////////////////////////
    //  Brand Relationships
    ///////////////////////////////////////////////////////////////////////////

    /**
     * Owner relationship, returns the brand's owner instance 
     * 
     * @return \App\User
     */
    public function owner()
    {
        return $this->belongsTo(User::class, self::PIVOT_OWNER_ID);
    }

    /**
     * Contact relationship, returns the brand's contact instance 
     * 
     * @return \App\Models\Contact
     */
    public function contacts()
    {
        return $this->hasMany(Contact::class, Contact::PIVOT_BRAND_ID);
    }

    /**
     * Container relationship, returns the brand's container instance 
     * 
     * @return \App\Models\Container
     */
    public function containers()
    {
        return $this->hasMany(Container::class, Container::PIVOT_BRAND_ID);
    }
}
