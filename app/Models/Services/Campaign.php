<?php

namespace App\Models\Services;

use App\Services\CampaignService;
use App\Traits\Uuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Campaign extends Model
{
    use Uuids;
    use SoftDeletes;

    ///////////////////////////////////////////////////////////////////////////
    //  Campaign Schema
    ///////////////////////////////////////////////////////////////////////////
    public const SCHEMA_TITLE           = 'title';
    public const SCHEMA_SUBJECT         = 'subject';
    public const SCHEMA_SLUG            = 'slug';
    public const SCHEMA_FROM_NAME       = 'from_name';
    public const SCHEMA_FROM_EMAIL      = 'from_email';
    public const SCHEMA_REPLY_TO        = 'reply_to';
    public const SCHEMA_TEMPLATE        = 'template';
    public const SCHEMA_DESCRIPTION     = 'description';
    public const SCHEMA_CONTENT         = 'content';
    public const SCHEMA_CONTENT_JSON    = 'content_json';
    public const SCHEMA_TEXT            = 'text';
    public const SCHEMA_TEXT_ONLY       = 'text_only';
    public const SCHEMA_STARTS_AT       = 'starts_at';
    public const SCHEMA_ENDS_AT         = 'ends_at';
    public const SCHEMA_PROGRESS        = 'progress';
    public const SCHEMA_ETA             = 'eta';
    public const SCHEMA_RECIPIENTS      = 'recipients';
    public const SCHEMA_SENT            = 'sent';
    public const SCHEMA_ERROR           = 'error';
    public const SCHEMA_ALLOWED_FILES   = 'allowed_files';
    public const SCHEMA_STATUS          = 'status';

    // pivoting constants 
    public const PIVOT_BRAND_ID         = 'brand_id';
    public const PIVOT_CONTAINER_ID     = 'container_id';
    
    ///////////////////////////////////////////////////////////////////////////
    //  Service info
    ///////////////////////////////////////////////////////////////////////////
    public const SERVICE                = CampaignService::class;
    public const SERVICE_NAME           = 'campaign';

    /**
     * The attributes that are mass assignable 
     * 
     * @var array 
     */
    protected $fillable = [
        self::SCHEMA_TITLE,
        self::SCHEMA_SUBJECT,
        self::SCHEMA_SLUG,
        self::SCHEMA_FROM_NAME,
        self::SCHEMA_FROM_EMAIL,
        self::SCHEMA_REPLY_TO,
        self::SCHEMA_TEMPLATE,
        self::SCHEMA_DESCRIPTION,
        self::SCHEMA_CONTENT,
        self::SCHEMA_CONTENT_JSON,
        self::SCHEMA_TEXT,
        self::SCHEMA_TEXT_ONLY,
        self::SCHEMA_STARTS_AT,
        self::SCHEMA_ENDS_AT,
        self::SCHEMA_PROGRESS,
        self::SCHEMA_ETA,
        self::SCHEMA_RECIPIENTS,
        self::SCHEMA_SENT,
        self::SCHEMA_ERROR,
        self::SCHEMA_ALLOWED_FILES,
        self::SCHEMA_STATUS,
        
        self::PIVOT_BRAND_ID,
        self::PIVOT_CONTAINER_ID,
    ];
}
