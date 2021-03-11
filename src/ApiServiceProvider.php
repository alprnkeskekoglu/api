<?php

namespace Dawnstar\Api;

use Dawnstar\Api\Providers\RouteServiceProvider;
use Illuminate\Support\ServiceProvider;

class ApiServiceProvider extends ServiceProvider
{


    public function register()
    {
        $this->app->register(RouteServiceProvider::class);
    }

    public function boot()
    {
        //
    }
}

