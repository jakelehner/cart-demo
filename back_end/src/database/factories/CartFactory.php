<?php 

use App\Models\Cart;

$factory->define(Cart::class, function (Faker\Generator $faker) {
    return [
        'user_fingerprint' => uniqid(),
    ];
});
