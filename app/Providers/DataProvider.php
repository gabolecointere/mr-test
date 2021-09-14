<?php

namespace App\Providers;

use App\Services\DataService;
use Illuminate\Support\ServiceProvider;

class DataProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $this->app->singleton(DataService::class, function () {
            return new DataService();
        });
    }
}
