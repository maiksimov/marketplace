<?php

namespace App\Http\Requests;

use App\Entities\Customer;
use App\Entities\CreditCard;
use App\Entities\Address;
use App\Factories\StateFactory;

class CreateOrderRequest extends AbstractSiteRequest
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
            'total_price' => 'required|string',
            'completed' => 'required|string',
            'state' => 'required|integer|in:' . implode(',', (new StateFactory())->allStates()),
            'customer_id' => 'required|integer|exists:' . (new Customer())->getTable() . ',id',
            'credit_card_id' => 'required|integer|exists:' . (new CreditCard())->getTable() . ',id',
            'billing_address_id' => 'required|integer|exists:' . (new Address())->getTable() . ',id',
            'shipping_address_id' => 'required|integer|exists:' . (new Address())->getTable() . ',id',
        ];
    }
}
