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
        return $this->init()->all();
    }

    public function findById(int $categoryId)
    {
        return $this->init()->findOrFail($categoryId);
    }

    public function create($data)
    {
        $newCategory = app($this->getModelClass());
        $newCategory->title = $data->title;
        $newCategory->save();
        return $newCategory;
    }

    public function updateById(int $categoryId, $data)
    {
        $category = $this->findById($categoryId);
        $category->title = $data->title;
        $category->save();
        return $category;
    }

    public function deleteById(int $categoryId)
    {
        $category = $this->findById($categoryId);
        return $category->delete();
    }
}