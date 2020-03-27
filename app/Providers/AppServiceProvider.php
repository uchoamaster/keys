<?php

namespace App\Providers;

use App\Keys\Human;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->singleton('human-verification', function () {
            return new Human();
        });
    }

    public function boot()
    {
        Route::pattern('pageNumber', '^\d+$');
    }
}
