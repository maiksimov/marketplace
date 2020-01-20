<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreateProductRequest;
use App\Http\Requests\SearchProductByPriceRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Repositories\ProductRepository;
use Illuminate\Http\Response;

class ProductController extends Controller
{
    private $productRepository;

    public function __construct()
    {
        $this->productRepository = app(ProductRepository::class);
    }

    public function index()
    {
        $products = $this->productRepository->all();
        return response()->json(['products' => $products], Response::HTTP_OK);
    }

    public function store(CreateProductRequest $request)
    {
        $product = $this->productRepository->create($request->all());
        return response()->json([ 'product' => $product ], Response::HTTP_CREATED);
    }

    public function show(int $productId)
    {
        $product = $this->productRepository->findById($productId);
        return response()->json(['products' => $product], Response::HTTP_OK);
    }

    public function update(int $productId, UpdateProductRequest $request)
    {
        $product = $this->productRepository->updateById($productId, $request->all());
        return response()->json(['category' => $product], Response::HTTP_OK);
    }

    public function destroy(int $productId)
    {
        $response = $this->productRepository->deleteById($productId);
        return response()->json(['deleted' => $response], Response::HTTP_OK);
    }

    public function searchByPrice(SearchProductByPriceRequest $request)
    {
        $products = $this->productRepository->searchByPrice($request->get('price'));
        return response()->json(['products' => $products], Response::HTTP_OK);
    }
}
