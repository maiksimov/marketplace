<?php

namespace App\Http\Requests;

use App\Entities\Category;

class CreateAddressRequest extends AbstractSiteRequest
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
            'zip_code' => 'required|string',
            'city' => 'required|string',
            'phone' => 'required|string',
            'country_id' => 'required|integer|exists:' . (new Category())->getTable() . ',id'
        ];
    }
}
