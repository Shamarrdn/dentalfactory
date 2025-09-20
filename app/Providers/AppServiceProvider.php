<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use App\View\Composers\CustomerLayoutComposer;
use App\Models\Cart;
use Illuminate\Support\Facades\Auth;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Register view composers
        View::composer('layouts.customer', CustomerLayoutComposer::class);

        View::composer('parts.navbar', function ($view) {
            $cartCount = 0;
            if (Auth::check()) {
                $cart = Cart::where('user_id', Auth::id())->first();
                if ($cart) {
                    $cartCount = $cart->items()->sum('quantity');
                }
            }
            
            // Debug information
            if(config('app.debug')) {
                \Log::info('Navbar ViewComposer cart count', [
                    'user_id' => Auth::id(),
                    'cartCount' => $cartCount
                ]);
            }
            
            $view->with('cartCount', $cartCount);
        });
    }
}
