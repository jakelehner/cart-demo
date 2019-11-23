<?php

namespace App\Http\Controllers;

use App\Http\Resources\CartResource;
use App\Models\Cart;
use App\Services\CartService\CartService;
use App\Services\ProductService\ProductService;

use Illuminate\Http\Request;

class CartController extends Controller
{
    /**
     * @var CartService
     */
    private $cartService;

    /**
     * @var ProductService
     */
    private $productService;

    /**
     * 
     * @param CartService $cartService
     * @param ProductService $productService
     */
    public function __construct(CartService $cartService, ProductService $productService)
    {
        $this->cartService = $cartService;
        $this->productService = $productService;
    }

    /**
     * Extracts the user fingerprint from the requet object.
     *
     * For demonstration purposes, this method returns a hard coded value.
     * This fingerprint can be overridden by setting the HTTP header 'x-fingerprint'
     * 
     * @param Request $request
     * @return string
     */
    private function fingerprintFromRequest(Request $request)
    {
        return $request->header('x-fingerprint') ?: '1234567890';
    }

    /**
     * Private function that returns a cart associated with a request.
     * This method returns a Cart object, and should be used for any
     * method in this class that needs the cart.
     *
     * @param Request $request
     * @return Cart
     */
    private function fetchUserCart(Request $request)
    {
        $fingerprint = $this->fingerprintFromRequest($request);
        return $this->cartService->fetchUserCart($fingerprint);
    }

    /**
     * Returns the user's cart to the API
     *
     * @param Request $request
     * @return CartResource
     */
    public function getUserCart(Request $request)
    {
        return new CartResource($this->fetchUserCart($request));
    }

    /**
     * Adds an item to the user's cart.
     *
     * @param Request $request
     * @return void
     */
    public function addItemToCart(Request $request)
    {
        $cart = $this->fetchUserCart($request);
        $postData = $this->validate($request, [
            'sku' => 'required|string',
            'quantity' => 'integer',
        ]);
        $product = $this->productService->fetchProductBySku($postData['sku']);
        $cart = $this->cartService->addItemToCart($cart, $product, $postData['quantity'] ?? 1);
        return new CartResource($cart);
    }

    /**
     * Updates the quantity for a single item in the cart.
     * Item will be added if it's not alread in the cart.
     *
     * @param Request $request
     * @return CartResource
     */
    public function updateCartItem(Request $request, $itemId)
    {
        $cart = $this->fetchUserCart($request);
        $postData = $this->validate($request, [
            'quantity' => 'required|integer',
        ]);
        $product = $this->productService->fetchProductById($itemId);
        $cart = $this->cartService->updateItemQuantity($cart, $product, $postData['quantity']);
        return new CartResource($cart);
    }

    /**
     * Removes an item from the cart.
     *
     * @param Request $request
     * @return CartResource
     */
    public function removeItemFromCart(Request $request, $itemId)
    {
        $cart = $this->fetchUserCart($request);
        $product = $this->productService->fetchProductById($itemId);
        $cart = $this->cartService->removeItemFromCart($cart, $product);
        return new CartResource($cart);
    }

    /**
     * Remoes all items from the cart.
     *
     * @param Request $request
     * @return CartResource
     */
    public function emptyCart(Request $request)
    {
        $cart = $this->fetchUserCart($request);
        $cart = $this->cartService->emptyCart($cart);
        return new CartResource($cart);
    }
}
