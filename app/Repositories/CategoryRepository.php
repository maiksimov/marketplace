<?php

namespace App\Repositories;

use App\Entities\Category as Model;

class CategoryRepository extends CoreRepository
{
    protected function getModelClass()
    {
        return Model::class;
    }

    public function all()
    {
        return $this->init()->with('products')->get();
    }
}