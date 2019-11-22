<?php

namespace Tests\Services;

use App\Models\Cart;
use App\Models\Product;
use App\Services\ProductService\ProductService;
use Laravel\Lumen\Testing\DatabaseTransactions;
use Illuminate\Support\Facades\App;
use Tests\TestCase;

class ProductServiceTest extends TestCase
{
    use DatabaseTransactions;
    
    private $productService;

    public function setUp(): void
    {
        parent::setup();
        $this->productService = App::make(ProductService::class);
    }

    public function testFetchProducts()
    {
        // Make suer we have some in the DB
        factory(Product::class, 5)->create();

        $products = $this->productService->fetchProducts();
        $allProducts = Product::all();
        $this->assertEquals($products->count(), $allProducts->count());
    }

    public function testFetchProductById()
    {
        $product = factory(Product::class, 5)->create()->random();
        $returnedProduct = $this->productService->fetchProductById($product->id);

        $this->assertInstanceOf(Product::class, $returnedProduct);
        $this->assertEquals($product->id, $returnedProduct->id);
    }

    public function testFetchProductBySku()
    {
        $product = factory(Product::class, 5)->create()->random();
        $returnedProduct = $this->productService->fetchProductBySku($product->sku);

        $this->assertInstanceOf(Product::class, $returnedProduct);
        $this->assertEquals($product->id, $returnedProduct->id);
    }

}
