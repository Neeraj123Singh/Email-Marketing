<?php

namespace App\Models\Internal;

use App\Models\Contact;
use App\Models\Services\Campaign;
use App\Traits\Uuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Email extends Model
{
    use Uuids;
    use SoftDeletes;

    ///////////////////////////////////////////////////////////////////////////
    //  Email Schema
    ///////////////////////////////////////////////////////////////////////////
    public const SCHEMA_SUBJECT         = 'subject';
    public const SCHEMA_PREHEADER       = 'preheader';
    public const SCHEMA_FROM_NAME       = 'from_name';
    public const SCHEMA_FROM_EMAIL      = 'from_email';
    public const SCHEMA_REPLY_TO        = 'reply_to';
    public const SCHEMA_CONTENT         = 'content';
    public const SCHEMA_TOKEN           = 'token';
    public const SCHEMA_TEXT            = 'text';
    public const SCHEMA_SES_MESSAGE_ID  = 'ses_message_id';
    public const SCHEMA_META            = 'meta';
    public const SCHEMA_SENT_ON         = 'sent_on';
    public const SCHEMA_OPENED_ON       = 'opened_on';
    public const SCHEMA_CLICKED_ON      = 'clicked_on';
    public const SCHEMA_STATUS          = 'status';

    // pivoting constants 
    public const PIVOT_CAMPAIGN_ID      = 'campaign_id';
    public const PIVOT_CONTACT_ID       = 'contact_id';

    /**
     * The attributes that are mass assignable 
     * 
     * @var array 
     */
    protected $fillable = [
        self::SCHEMA_SUBJECT,
        self::SCHEMA_PREHEADER,
        self::SCHEMA_FROM_NAME,
        self::SCHEMA_FROM_EMAIL,
        self::SCHEMA_REPLY_TO,
        self::SCHEMA_CONTENT,
        self::SCHEMA_CONTENT,
        self::SCHEMA_TOKEN,
        self::SCHEMA_SES_MESSAGE_ID,
        self::SCHEMA_META,
        self::SCHEMA_SENT_ON,
        self::SCHEMA_OPENED_ON,
        self::SCHEMA_CLICKED_ON,
        self::SCHEMA_STATUS,

        self::PIVOT_CAMPAIGN_ID,
        self::PIVOT_CONTACT_ID,
    ];

    ///////////////////////////////////////////////////////////////////////////
    //  Email's Relationships
    ///////////////////////////////////////////////////////////////////////////

    /**
     * Contact relationship, returns the contact's instance 
     * 
     * @return \App\Models\Contact
     */
    public function contact()
    {
        return $this->belongsTo(Contact::class, self::PIVOT_CONTACT_ID);
    }

    /**
     * Campaign relationship, returns the email's campaign
     * 
     * @return \App\Models\Services\Campaign
     */
    public function campaign()
    {
        return $this->belongsTo(Campaign::class, self::PIVOT_CAMPAIGN_ID);
    }
}
