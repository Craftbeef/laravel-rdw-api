<?php

namespace Craftbeef\LaravelRdwApi;

use Illuminate\Support\ServiceProvider;

class LaravelRDWApiServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     */
    public function boot()
    {
        if ($this->app->runningInConsole()) {
            $this->publishes([
                __DIR__ . '/../config/config.php' => config_path('laravel-rdw-api.php'),
            ], 'config');
        }
    }

    /**
     * Register the application services.
     */
    public function register()
    {
        // Automatically apply the package configuration
        $this->mergeConfigFrom(__DIR__ . '/../config/config.php', 'laravel-rdw-api');

        // Register the main class to use with the facade
        $this->app->singleton(LaravelRDWApi::class, function () {
            return new LaravelRDWApi();
        });

        $this->app->alias(LaravelRDWApi::class, 'RDWApi');
    }
}
