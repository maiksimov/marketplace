<?php

namespace App\Http\Controllers;

use App\Repositories\CategoryRepository;

class CategoryController extends Controller
{
    private $categoryRepository;

    public function __construct()
    {
        $this->categoryRepository = app(CategoryRepository::class);
    }

    public function index()
    {
        $categories = $this->categoryRepository->all();
        return view('category.index', ['categories' => $categories]);
    }
}
