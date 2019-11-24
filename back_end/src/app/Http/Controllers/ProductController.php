<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Product;
use App\Models\Cart;
use App\Http\Resources\ProductResource;
use App\Services\ProductService\ProductService;

class ProductController extends Controller
{
    /**
     * @var ProductService
     */
    private $productService;

    /**
     * Create a new controller instance.
     *
     * @var ProductService $productService
     * @return void
     */
    public function __construct(ProductService $productService)
    {
        $this->productService = $productService;
    }

    /**
     * Returns all products
     *
     * @param Request $request
     * @return void
     */
    public function getProducts(Request $request)
    {
        return ProductResource::collection($this->productService->fetchProducts());
    }
}
