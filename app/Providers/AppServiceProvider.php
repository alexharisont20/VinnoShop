<?php

namespace App\Providers;

use Illuminate\Routing\UrlGenerator;
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
        $this->app->singleton('url', function ($app) {
            $app->instance('request', $app['request']);
            
            return new UrlGenerator($app['router']->getRoutes(), $app['request'], 'https://s3.tebi.io/vinnoshop');
        });
        $this->app->bind("pathao", function () {
            return new \App\Pathao\Manage\Manage(
                new \App\Pathao\Apis\AreaApi(),
                new \App\Pathao\Apis\StoreApi(),
                new \App\Pathao\Apis\OrderApi()
            );
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
