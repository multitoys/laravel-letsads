<?php

namespace Rhinodontypicus\LetsAds;

use Illuminate\Support\ServiceProvider;

class LetsAdsServiceProvider extends ServiceProvider
{
    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton('letsads', function () {
            return new LetsAds([
                'login' => config('letsads.login'),
                'password' => config('letsads.password'),
            ], new LetsAdsGateway());
        });

        $this->mergeConfigFrom(__DIR__.'/config/main.php', 'letsads');
    }

    /**
     * Perform post-registration booting of services.
     *
     * @return void
     */
    public function boot()
    {
        $this->publishes([
            __DIR__.'/config/main.php' => config_path('letsads.php'),
        ]);
    }
}
