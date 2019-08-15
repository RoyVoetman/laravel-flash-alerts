<?php

namespace RoyVoetman\LaravelFlashAlerts;

use Illuminate\Support\ServiceProvider;

class FlashAlertsServiceProvider extends ServiceProvider
{
    /**
     * Perform post-registration booting of services.
     */
    public function boot()
    {
        $this->loadTranslationsFrom(__DIR__.'/../lang', 'laravel-flash-alerts');
    
        $this->publishes([
            __DIR__.'/../lang' => resource_path('lang/vendor/laravel-flash-alerts'),
        ]);
    }

    /**
     * Register bindings in the container.
     */
    public function register()
    {
        //
    }
}