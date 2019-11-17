<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

use Illuminate\Support\Facades\Schema;

use Illuminate\Support\Facades\Validator;

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
        // Setting default string length for xampp DB
        Schema::defaultStringLength(191);

        // Rename validators
        Validator::extend('latlng', 'App\\Rules\\LatLngValidator@passes');
        // Register the Recaptcha rule
        Validator::extend('recaptcha', 'App\\Rules\\CaptchaValidator@passes');
    }
}
