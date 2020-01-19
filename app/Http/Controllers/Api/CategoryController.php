<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryRequest;
use App\Repositories\CategoryRepository;
use Illuminate\Http\Response;

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
        return response()->json(['categories' => $categories], Response::HTTP_OK);
    }

    public function store(CategoryRequest $request)
    {
        $category = $this->categoryRepository->create($request);
        return response()->json(['category' => $category], Response::HTTP_CREATED);
    }

    public function show(int $categoryId)
    {
        $category = $this->categoryRepository->findById($categoryId);
        return response()->json(['category' => $category], Response::HTTP_OK);
    }

    public function update(int $categoryId, CategoryRequest $request)
    {
        $category = $this->categoryRepository->updateById($categoryId, $request);
        return response()->json(['category' => $category], Response::HTTP_OK);
    }

    public function destroy(int $categoryId)
    {
        $response = $this->categoryRepository->deleteById($categoryId);
        return response()->json(['deleted' => $response], Response::HTTP_OK);
    }
}
