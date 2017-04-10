<?php

namespace ZCJY\Pinche\Http\Requests\API;

use ZCJY\Pinche\Models\Info;
use InfyOm\Generator\Request\APIRequest;

class CreateInfoAPIRequest extends APIRequest
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
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return Info::$rules;
    }
}
