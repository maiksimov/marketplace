<?php

namespace App\Http\Requests;

use App\Entities\Category;

class UpdateCategoryRequest extends AbstractSiteRequest
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
            'title' => 'sometimes|string|unique:' .  (new Category())->getTable(),
        ];
    }
}
