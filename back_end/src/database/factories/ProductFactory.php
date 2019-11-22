<?php 

use App\Models\Product;

$factory->define(Product::class, function (Faker\Generator $faker) {
    return [
        'sku' => 'sku-' . uniqid(),
        'display_name' => "Product " . rand(1000, 9999),
        'unit_cost' => round(rand(100, 10000), -1) / 100,
    ];
});
