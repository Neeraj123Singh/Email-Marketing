<?php

namespace App\Services;

use App\Models\Internal\Email;

class EmailService
{

    private const LINK_FILTERING_REGEX = "/(<a[^>]*href=['\"])([^'\"]*)/";

    public function find($value, $where = 'uuid')
    {
        return Email::where($where, $value)->first();
    }
}
