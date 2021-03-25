<?php

namespace Dawnstar\Api;

use Dawnstar\Api\Http\Middleware\ApiAuthenticate;
use Dawnstar\Api\Http\Middleware\Authenticate;
use Dawnstar\Api\Providers\ConfigServiceProvider;
use Dawnstar\Api\Providers\RouteServiceProvider;
use Illuminate\Routing\Router;
use Illuminate\Support\ServiceProvider;
use Laravel\Sanctum\HasApiTokens;

class ApiServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->register(RouteServiceProvider::class);
        config([
            'auth.guards.apiAdmin' => [
                'driver' => 'sanctum',
                'provider' => 'apiAdmins',
            ],
            'auth.providers.apiAdmins' => [
                'driver' => 'eloquent',
                'model' => \Dawnstar\Api\Models\Admin::class,
            ]
        ]);
    }

    public function boot()
    {
        $router = $this->app->make(Router::class);

        $router->pushMiddlewareToGroup('api', \Laravel\Sanctum\Http\Middleware\EnsureFrontendRequestsAreStateful::class);
        $router->aliasMiddleware('dawnstarApiAuth', ApiAuthenticate::class);
    }
}

