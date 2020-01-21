<?php

namespace App\Http\Requests;

use App\Entities\Customer;

class CreateCustomerRequest extends AbstractSiteRequest
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
            'first_name' => 'required|string',
            'last_name' => 'required|string',
            'email' => 'required|email|unique:' . (new Customer())->getTable(),
            'password' => 'required|string|min:6|confirmed',
        ];
    }
}
