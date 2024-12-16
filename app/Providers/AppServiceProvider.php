<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Services\JsonFileService;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(JsonFileService::class, function ($app) {
            return new JsonFileService();
        });
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
