<?php

namespace App\Models;

use App\Traits\Uuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Contact extends Model
{
    use Uuids;
    use SoftDeletes;

    ///////////////////////////////////////////////////////////////////////////
    //  Contact Schema
    ///////////////////////////////////////////////////////////////////////////
    public const SCHEMA_EMAIL       = 'email';
    public const SCHEMA_FIRST_NAME  = 'first_name';
    public const SCHEMA_LAST_NAME   = 'last_name';
    public const SCHEMA_BOUNCED     = 'bounced';
    public const SCHEMA_PHONE       = 'phone';

    // pivoting constants 
    public const PIVOT_BRAND_ID     = 'brand_id';
    public const PIVOT_AUDIENCE_ID  = 'audience_id';

    /**
     * The attributes that are mass assignable 
     * 
     * @var array 
     */
    protected $fillable = [
        self::SCHEMA_EMAIL,
        self::SCHEMA_FIRST_NAME,
        self::SCHEMA_LAST_NAME,
        self::SCHEMA_BOUNCED,
        self::SCHEMA_PHONE,
        self::PIVOT_BRAND_ID,
    ];

    ///////////////////////////////////////////////////////////////////////////
    //  Contact Relationships
    ///////////////////////////////////////////////////////////////////////////

    /**
     * Brand relationship, returns the contact's brand instance
     * 
     * @var \App\Models\Brand
     */
    public function brand()
    {
        return $this->belongsTo(Brand::class, self::PIVOT_BRAND_ID);
    }

    /**
     * Brand relationship, returns the contact's brand instance
     * 
     * @var \App\Models\Audience
     */
    public function audience()
    {
        return $this->belongsToMany(
            Audience::class,
            'contact_audience',
            self::PIVOT_AUDIENCE_ID,
            Audience::PIVOT_CONTACT_ID
        )->withTimestamps();
    }
}
