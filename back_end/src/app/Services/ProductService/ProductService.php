<?php

namespace App\Services\ProductService;

use App\Models\Cart;
use App\Models\Product;

class ProductService
{

    public function __construct()
    {
        
    }

    /**
     * Returns products from the db.
     * Currently just returns all products.
     *
     * @param array $params
     * @return Product[]
     */
    public function fetchProducts($params = [])
    {
        return Product::all();
    }

    /**
     * Returns a product for a provided id. Throws an exception if not found
     *
     * @param $id
     * @return Product
     * @throws ModelNotFoundException
     */
    public function fetchProductById($id)
    {
        return Product::findOrFail($id);
    }

    /**
     * Returns a product for a provided sku. Throws an exception if not found
     *
     * @param string $sku
     * @return Product
     * @throws ModelNotFoundException
     */
    public function fetchProductBySku(string $sku)
    {
        return Product::where('sku', $sku)->firstOrFail();
    }

}
