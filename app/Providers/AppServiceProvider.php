<?php

namespace App\Providers;

use Illuminate\Support\Facades\Validator;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;

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
        Schema::defaultStringLength(191);
        date_default_timezone_set('Asia/Makassar');

         Validator::extend('gk_first_required', function ($attribute, $value, $parameters, $validator) {
        return !empty($value[0]);
    });

    Validator::replacer('gk_first_required', function ($message, $attribute, $rule, $parameters) {
        return str_replace(':attribute', $attribute, 'The '.$attribute.' field must not be empty.');
    });
    }
}
