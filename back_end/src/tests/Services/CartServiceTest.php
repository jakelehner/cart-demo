<?php

namespace Tests\Services;

use App\Models\Cart;
use App\Models\Product;
use App\Services\CartService\CartService;
use Laravel\Lumen\Testing\DatabaseTransactions;
use Illuminate\Support\Facades\App;
use Tests\TestCase;

class CartServiceTest extends TestCase
{
    use DatabaseTransactions;
    
    private $cartService;

    public function setUp(): void
    {
        parent::setup();
        $this->cartService = App::make(CartService::class);
    }

    public function testFetchUserCart()
    {
        $fingerprint = uniqid();

        // Cart should not exist in DB
        $this->assertEmpty(Cart::where('user_fingerprint', $fingerprint)->get());

        $cart = $this->cartService->fetchUserCart($fingerprint);
        $cart2 = $this->cartService->fetchUserCart($fingerprint);

        // Should exist in DB. Only once. $cart & $cart2 should be the same
        $this->assertEquals(1, Cart::where('user_fingerprint', $fingerprint)->get()->count());
        $this->assertInstanceOf(Cart::class, $cart);
        $this->assertInstanceOf(Cart::class, $cart2);
        $this->assertEquals($cart->id, $cart2->id);
    }

    public function testAddItemToCart() 
    {
        $products = factory(Product::class, 2)->create();
        $cart = factory(Cart::class)->create();
        
        // Cart should be empty
        $cart->load('items');
        $this->assertEmpty($cart->items);
        $this->assertEquals(0, $cart->itemCountTotal);
        $this->assertEquals(0, $cart->itemCountUnique);

        // Add Items
        $this->cartService->addItemToCart($cart, $products[0]);
        $this->cartService->addItemToCart($cart, $products[1], 2);
        
        $cart->load('items');
        $this->assertEquals(2, $cart->items->count());
        $this->assertEquals(3, $cart->items->sum('pivot.quantity'));
    }

    public function testUpdateItemQuantity()
    {
        $product = factory(Product::class)->create();
        $cart = factory(Cart::class)->create();
    
        // Should add item to cart        
        $cart = $this->cartService->updateItemQuantity($cart, $product);
        $this->assertEquals(1, $cart->items->count());
        $this->assertEquals(1, $cart->items[0]->pivot->quantity);

        // Should update quantity
        $cart = $this->cartService->updateItemQuantity($cart, $product, 5);
        $this->assertEquals(1, $cart->items->count());
        $this->assertEquals(5, $cart->items[0]->pivot->quantity);

        // Should remove from cart
        $this->cartService->updateItemQuantity($cart, $product, 0);
        $this->assertEmpty($cart->items); 
    }

    public function testRemoveItemFromCart()
    {
        $products = factory(Product::class, 2)->create();
        $cart = factory(Cart::class)->create();
        $cart->items()->attach($products);

        $this->assertEquals(2, $cart->items->count());
        $this->assertInstanceOf(Product::class, $cart->items->firstWhere('id', $products[0]->id));

        // Should remove from cart
        $cart = $this->cartService->removeItemFromCart($cart, $products[0]);
        $this->assertEquals(1, $cart->items->count());
        $this->assertNull($cart->items->firstWhere('id', $products[0]->id));
    }

    public function testEmptyCart()
    {
        $products = factory(Product::class, 2)->create();
        $cart = factory(Cart::class)->create();
        $cart->items()->attach($products);

        $this->assertEquals(2, $cart->items->count());
        $cart = $this->cartService->emptyCart($cart);
        $this->assertEquals(0, $cart->items->count());
    }

}
