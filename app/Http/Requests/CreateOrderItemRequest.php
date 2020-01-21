<?php

namespace App\Http\Requests;

use App\Entities\Order;
use App\Entities\Product;

class CreateOrderItemRequest extends AbstractSiteRequest
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
            'order_id' => 'required|integer|exists:' . (new Order())->getTable() . ',id',
            'product_id' => 'required|integer|exists:' . (new Product())->getTable() . ',id',
            'price' => 'required|numeric',
            'quantity' => 'required|integer|min:1'
        ];
    }
}
