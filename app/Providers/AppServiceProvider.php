<?php

namespace App\Providers;

use App\Components\Tracking\{TrackingInterface, TrackingService};

class AppServiceProvider extends ServiceProvider
{
    public function boot()
    {
        //
    }

    public function register()
    {
        $this->app->singleton(TrackingInterface::class, TrackingService::class);
    }
}
