<?php

namespace Kdion4891\Lac\Providers;

use Illuminate\Support\ServiceProvider;
use Kdion4891\Lac\Console\Commands\LacAuthCommand;
use Kdion4891\Lac\Console\Commands\LacMakeCommand;

class LacServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $this->publishes([__DIR__ . '/../../public' => public_path()], ['install', 'public']);
        $this->publishes([__DIR__ . '/../../resources/views/layouts/nav.blade.php' => resource_path('views/vendor/lac/layouts/nav.blade.php')], ['install', 'nav']);
        $this->publishes([__DIR__ . '/../../resources/views/layouts/app.blade.php' => resource_path('views/vendor/lac/layouts/app.blade.php')], ['install', 'layout']);
        $this->publishes([__DIR__ . '/../../resources/views/auth' => resource_path('views/vendor/lac/auth')], ['auth', 'views']);
        $this->publishes([__DIR__ . '/../../resources/views/inputs' => resource_path('views/vendor/lac/inputs')], ['inputs', 'views']);
        $this->publishes([__DIR__ . '/../../resources/views/layouts' => resource_path('views/vendor/lac/layouts')], ['layouts', 'views']);
        $this->publishes([__DIR__ . '/../../resources/views/models' => resource_path('views/vendor/lac/models')], ['models', 'views']);

        $this->loadViewsFrom(__DIR__ . '/../../resources/views', 'lac');

        if ($this->app->runningInConsole()) {
            $this->commands([LacMakeCommand::class, LacAuthCommand::class]);
        }
    }
}
