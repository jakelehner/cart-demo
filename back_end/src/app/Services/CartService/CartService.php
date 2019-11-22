<?php

namespace App\Services\CartService;

use App\Models\Cart;
use App\Models\Product;

class CartService
{

    public function __construct()
    {
        
    }

    /**
     * Returns the cart for a given user fingerprint. 
     * Creates a new cart if not found by default.
     *
     * @param string $userFingerprint
     * @param boolean $createIfNotFound
     * @return Cart|bool
     */
    public function fetchUserCart(string $userFingerprint, $createIfNotFound = true)
    {
        $cart = Cart::where('user_fingerprint', $userFingerprint)
            ->with('items')
            ->first();
        if (!$cart && $createIfNotFound) {
            $cart = $this->newUserCart($userFingerprint);
        }
        return $cart;
    }

    /**
     * Adds an item to a cart with a default quantitiy of 1.
     *
     * @param Cart $cart
     * @param Product $product
     * @param integer $quantity
     * @return Cart
     */
    public function addItemToCart(Cart $cart, Product $product, int $quantity = 1)
    {
        if ($oldItem = $cart->items->firstWhere('id', $product->id)) {
            // Item already in cart, update quantity
            $newQuantity = $oldItem->pivot->quantity + $quantity;
            $cart = $this->updateItemQuantity($cart, $product, $newQuantity);
        } else {
            $cart->items()->attach($product, [
                'quantity' => $quantity,
            ]);
        }
        
        $cart->load('items');
        return $cart;
    }

    /**
     * Updates an item's quantity.
     * If quantity is 0, the item is removed.
     * If the item isn't currently in the cart, it's added.
     *
     * @param Cart $cart
     * @param Product $product
     * @param integer $quantity
     * @return Cart
     */
    public function updateItemQuantity(Cart $cart, Product $product, int $quantity = 1)
    {
        if ($quantity == 0) {
            return $this->removeItemFromCart($cart, $product);
        } elseif ($item = $cart->items->firstWhere('id', $product->id)) {
            $item->pivot->quantity = $quantity;
            $item->pivot->save();
            $cart->load('items');
            return $cart;
        } else {
            return $this->addItemToCart($cart, $product, $quantity);
        }
    }

    /**
     * Removs an item from a cart.
     *
     * @param Cart $cart
     * @param Product $product
     * @return Cart
     */
    public function removeItemFromCart(Cart $cart, Product $product)
    {
        $cart->items()->detach($product);
        $cart->load('items');
        return $cart;
    }

    /**
     * Removes all items from the cart.
     *
     * @param Cart $cart
     * @return Cart
     */
    public function emptyCart($cart)
    {
        $cart->items()->delete();
        $cart->load('items');
        return $cart;
    }

    /**
     * Creates a new empty cart
     *
     * @param string $userFingerprint
     * @return Cart
     */
    private function newUserCart(string $userFingerprint = null)
    {
        return Cart::create([
            'user_fingerprint' => $userFingerprint ?? uniqid(),
        ])->load('items');
    }
}
