<?php

namespace App\Http\Requests;

use App\Entities\Category;

class CreateProductRequest extends AbstractSiteRequest
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
            'title' => 'required|string',
            'description' => 'nullable|string',
            'price' => 'required|numeric',
            'in_stock' => 'required|integer',
            'category_id' => 'required|integer|exists:' . (new Category())->getTable() . ',id'
        ];
    }
}
