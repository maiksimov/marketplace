<?php

namespace App\Repositories;

abstract class CoreRepository
{
    private $model;

    public function __construct()
    {
        $this->model = app($this->getModelClass());
    }

    abstract protected function getModelClass();

    protected function init()
    {
        return clone $this->model;
    }

    public function findById(int $modelId)
    {
        return $this->init()->findOrFail($modelId);
    }

    public function deleteById(int $modelId)
    {
        $model = $this->findById($modelId);
        return $model->delete();
    }

    public function create($data)
    {
        $newModel = app($this->getModelClass());
        $newModel->fill($data);
        $newModel->save();
        return $newModel;
    }

    public function updateById(int $modelId, $data)
    {
        $model = $this->findById($modelId);
        $model->update($data);
        return $model;
    }
}