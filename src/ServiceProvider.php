<?php

namespace Hedeqiang\Antispam;

class ServiceProvider extends \Illuminate\Support\ServiceProvider
{
    protected $defer = true;

    public function boot()
    {
        $this->publishes([
            __DIR__.'/Config/antispam.php' => config_path('antispam.php'),
        ],'antispam');
    }

    public function register()
    {
        $this->app->singleton(Antispam::class, function () {
            return new Antispam(config('antispam'));
        });

        $this->app->alias(Antispam::class, 'antispam');
    }

    public function provides()
    {
        return [Antispam::class, 'antispam'];
    }
}
