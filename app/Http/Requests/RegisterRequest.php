<?php

/**
 * RegisterRequest.php
 * 
 * @since 23 Aug, 2020
 * @copyright Grorapid @ 2020
 * @author Manish Sahani <rec.manish.sahani@gmail.com>
 */

namespace App\Http\Requests;

use App\User;
use App\Utilities\HelperUtility;
use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
{
    ///////////////////////////////////////////////////////////////////////////
    //  Register Request - Validation Rules for registering a user
    ///////////////////////////////////////////////////////////////////////////

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    public function prepareForValidation()
    {
        $this->merge([
            User::SCHEMA_FIRST_NAME => ucfirst(HelperUtility::split_name($this->instance()->get(User::SCHEMA_NAME))[0]),
            User::SCHEMA_LAST_NAME  => ucfirst(HelperUtility::split_name($this->instance()->get(User::SCHEMA_NAME))[1]),
        ]);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'email'     => 'required|string|max:255|unique:users',
            'password'  => 'required|string|min:8',
            'name'      => 'required|string|max:255'
        ];
    }
}
