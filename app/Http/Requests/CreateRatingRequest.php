<?php

namespace App\Http\Requests;

use App\Entities\Customer;
use App\Entities\Product;

class CreateRatingRequest extends AbstractSiteRequest
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
            'review' => 'required|string',
            'rating' => 'required|integer|min:0|max:10',
            'customer_id' => 'required|integer|exists:' . (new Customer())->getTable() . ',id',
            'product_id' => 'required|integer|exists:' . (new Product())->getTable() . ',id'
        ];
    }
}
