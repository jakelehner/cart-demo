<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/

$router->get('/products', ['uses' => 'ProductController@getProducts', 'as' => 'getProducts']);

$router->get('/cart', ['uses' => 'CartController@getUserCart', 'as' => 'getUserCart']);

$router->post('/cart/items', ['uses' => 'CartController@addItemToCart', 'as' => 'addItemToCart']);
$router->delete('/cart/items', ['uses' => 'CartController@emptyCart', 'as' => 'emptyCart']);

$router->post('/cart/items/{itemId}', ['uses' => 'CartController@updateCartItem', 'as' => 'updateCartItem']);
$router->delete('/cart/items/{itemId}', ['uses' => 'CartController@removeItemFromCart', 'as' => 'removeItemFromCart']);
