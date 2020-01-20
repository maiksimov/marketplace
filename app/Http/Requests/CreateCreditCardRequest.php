<?php

namespace App\Http\Requests;

use App\Entities\Country;

class CreateCreditCardRequest extends AbstractSiteRequest
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
        return [
            'address' => 'required|string',
            'zip_code' => 'required|integer|size:5',
            'city' => 'required|string',
            'phone' => 'required|string',
            'country_id' => 'required|integer|exists:' . (new Country())->getTable() . ',id'
        ];
    }
}
