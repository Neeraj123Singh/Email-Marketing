<?php

namespace App\Http\Requests;

use App\Utilities\TypeUtility;
use Illuminate\Foundation\Http\FormRequest;

class ContainerRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * 
     */
    public function prepareForValidation()
    {
        $this->merge([
            'type' => TypeUtility::firstOrFail($this->instance()->get('type')),
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
            'type'  => 'required'
        ];
    }
}
