<?php

namespace SaC\LoggerLineNotify;

use Illuminate\Support\ServiceProvider;
use SaC\LoggerLineNotify\Logging\Main;

class LineNotifyServiceProvider extends ServiceProvider
{

    /**
     * for publish to config => `php artisan vendor:publish ...`
     * @return void
     */
    public function boot(): void
    {
        $source = realpath($raw = __DIR__.'/../config/line.php') ?: $raw;
        $this->publishes([
            $source => config_path('line.php'),
        ]);
    }

    // register package for core
    public function register()
    {
        $configPath = __DIR__ . '/../config/line.php';
        $this->mergeConfigFrom($configPath, 'line');

        $this->app->singleton('LineNotify', function ($app) {
            return new Main();
        });
    }
}