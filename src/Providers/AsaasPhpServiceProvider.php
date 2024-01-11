<?php

namespace TioJobs\AsaasPhp\Providers;

use Illuminate\Support\ServiceProvider;
use TioJobs\AsaasPhp\Core\Asaas;

class AsaasPhpServiceProvider extends ServiceProvider
{
    /** @return void */
    public function register()
    {
        $this->mergeConfigFrom(__DIR__.'/../../config/asaas-php.php', 'asaas-php');

        $this->app->bind('asaas-php', fn () => new Asaas());
    }

    /** @return void */
    public function boot()
    {
        $this->publishes([
            __DIR__.'/../../config/asaas-php.php' => base_path('config/asaas-php.php'),
        ], 'config');
    }
}
