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
}