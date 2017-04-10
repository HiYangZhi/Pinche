<?php

namespace ZCJY\Pinche\Http\Requests\API;

use ZCJY\Pinche\Models\Passenger;
use InfyOm\Generator\Request\APIRequest;

class CreatePassengerAPIRequest extends APIRequest
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
        return Passenger::$rules;
    }
}
