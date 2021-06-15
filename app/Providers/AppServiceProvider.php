<?php

namespace App\Providers;

use Braintree\BraintreeConfiguration;
use Braintree\Gateway;
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
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->app->bind(Gateway::class, function ($app) {
            return new Gateway($app['config']['braintree']);
        });
    }
}
