<?php

namespace App\Http\Requests;

use App\Entities\Category;

class UpdateProductRequest extends AbstractSiteRequest
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
            'title' => 'sometimes|string',
            'description' => 'sometimes|string',
            'price' => 'sometimes|numeric',
            'in_stock' => 'sometimes|integer',
            'category_id' => 'sometimes|integer|exists:' . (new Category())->getTable() . ',id'
        ];
    }
}
