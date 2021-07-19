<?php

/**
 * User.php
 * 
 * @since 23 Aug, 2020
 * @copyright Grorapid @ 2020
 * @author Manish Sahani <rec.manish.sahani@gmail.com>
 */

namespace App;

use App\Models\Brand;
use App\Traits\Uuids;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;
use Laratrust\Traits\LaratrustUserTrait;

class User extends Authenticatable
{
    use LaratrustUserTrait;
    use SoftDeletes;
    use Notifiable, HasApiTokens, Uuids;

    ///////////////////////////////////////////////////////////////////////////
    //  User Schema
    ///////////////////////////////////////////////////////////////////////////
    public const SCHEMA_NAME                = 'name';
    public const SCHEMA_FIRST_NAME          = 'first_name';
    public const SCHEMA_LAST_NAME           = 'last_name';
    public const SCHEMA_USERNAME            = 'username';
    public const SCHEMA_EMAIL               = 'email';
    public const SCHEMA_PASSWORD            = 'password';
    public const SCHEMA_ACTIVE              = 'active';
    public const SCHEMA_PHONE               = 'phone';
    public const SCHEMA_COUNTRY_CODE        = 'country_code';
    public const SCHEMA_TIMEZONE            = 'timezone';
    public const SCHEMA_LAST_ACCESSED       = 'last_accessed';
    public const SCHEMA_LOGIN_COUNT         = 'login_count';
    public const SCHEMA_ADDRESS_TEXT        = 'address_text';
    public const SCHEMA_COUNTRY             = 'country';
    public const SCHEMA_STATE               = 'state';
    public const SCHEMA_CITY                = 'city';
    public const SCHEMA_ZIP_CODE            = 'zip_code';
    public const SCHEMA_EMAIL_VERIFIED_AT   = 'email_verified_at';

    // Pivoting constants 
    public const PIVOT_ROLE_ID              = 'role_id';

    // relationship keys constants 
    public const RELATION_BRAND             = 'brand';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'first_name', 'last_name', 'email', 'password', 'google_id', 
        'phone', 'country_code', 'username', 'timezone', 'last_accessed', 
        'login_count', 'address_text', 'country', 'state', 'city', 
        'zip_code', 'active'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    ///////////////////////////////////////////////////////////////////////////
    //  User's Relationships
    ///////////////////////////////////////////////////////////////////////////

    /**
     * Brand relationship, returns the brand's instance 
     * 
     * @return \App\Models\Brand
     */
    public function brands()
    {
        return $this->hasMany(Brand::class, Brand::PIVOT_OWNER_ID);
    }
}
