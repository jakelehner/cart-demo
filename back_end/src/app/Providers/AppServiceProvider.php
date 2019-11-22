<?php

namespace App\Providers;

use App\Services\CartService\CartService;
use App\Services\ProductService\ProductService;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(CartService::class, function ($app) {
            return new CartService();
        });

        $this->app->singleton(ProductService::class, function ($app) {
            return new ProductService();
        });
    }
}
