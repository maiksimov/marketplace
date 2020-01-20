<?php

namespace App\Http\Controllers;

use App\Http\Requests\SearchProductByPriceRequest;
use App\Repositories\ProductRepository;

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
        return view('product.index', ['products' => $products]);
    }


    public function searchByPrice(SearchProductByPriceRequest $request)
    {
        $products = $this->productRepository->searchByPrice($request->get('price'));
        return view('product.index', ['products' => $products]);
    }
}
