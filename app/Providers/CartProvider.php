<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Cart\Cart;

class CartProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind('App\Cart\IStorage', 'App\Cart\SessionStorage');
        $this->app->bind(Cart::class, function($app) {
            return new Cart($app['App\Cart\IStorage']);
        });
    }
}
