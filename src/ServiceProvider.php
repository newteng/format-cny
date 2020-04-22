<?php

namespace Newteng\FormatCny;


class ServiceProvider extends \Illuminate\Support\ServiceProvider
{
    protected $defer = true;

    public function register()
    {
        $this->app->singleton(Cny::class, function () {
            return new Cny();
        });

        $this->app->alias(Cny::class, 'cny');
    }

    public function provides()
    {
        return [Cny::class, 'cny'];
    }
}