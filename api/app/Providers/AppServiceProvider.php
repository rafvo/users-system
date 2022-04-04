<?php

namespace App\Providers;

use Illuminate\Support\Facades\Validator;
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
        // só serão aceitos letras e espaços 
        Validator::extend('alpha_spaces', function ($attribute, $value) {
            // aceitar hífens também: /^[\pL\s-]+$/u.
            return preg_match('/^[\pL\s]+$/u', $value); 
        });
    }
}
