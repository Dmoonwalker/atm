<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Services\TwoChatService;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->singleton(TwoChatService::class, function ($app) {
            return new TwoChatService();
        });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
