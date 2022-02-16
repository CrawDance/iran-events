<?php

namespace CrawDance\IranEvents\Providers;
use CrawDance\IranEvents\IranEvents;
use Illuminate\Support\ServiceProvider as ServiceProviderAlias;
/**
 * Developer: Keivan
 * E-mail: me@keiv.ir
 * Date:
 */

class IranEventsServiceProvider extends ServiceProviderAlias
{
    public function boot()
    {

    }

    public function register()
    {
        $this->app->bind('iran_events', function ($app) {
            return new IranEvents();
        });
    }

    public function provides()
    {
        return ['iran_events'];
    }
}
