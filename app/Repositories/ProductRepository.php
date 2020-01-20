<?php

namespace App\Repositories;

use App\Entities\Product as Model;

class ProductRepository extends CoreRepository
{
    protected function getModelClass()
    {
        return Model::class;
    }

    public function all()
    {
        return $this->init()->with('category')->get();
    }

    public function searchByPrice($price)
    {
        return $this->init()->with('category')->where('price', '<=', $price )->get();
    }
}