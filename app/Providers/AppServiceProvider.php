<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Auth;
use App\Infrastructure\Repositories\Interfaces\CartRepositoryInterface;
use App\Infrastructure\Repositories\DbCartRepository;
use App\Infrastructure\Repositories\SessionCartRepository;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        // Special case for cart repository as it depends on auth state
        $this->app->singleton(CartRepositoryInterface::class, function ($app) {
            if (Auth::check()) {
                return $app->make(DbCartRepository::class); 
            } else {
                return $app->make(SessionCartRepository::class); 
            }
        });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {

    }
}
