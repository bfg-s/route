<?php

namespace Bfg\Route;

use Bfg\Route\Core\RouteMixin;
use Illuminate\Routing\Router;
use Illuminate\Support\ServiceProvider;

class RouteServiceProvider extends ServiceProvider
{
    public function boot()
    {
        if ($this->app->runningInConsole()) {
            $this->publishes([
                __DIR__ . '/../config/route-attributes.php' => config_path('route-attributes.php'),
            ], 'config');
        }

        //$this->registerRoutes();
    }

    public function register()
    {
        $this->mergeConfigFrom(__DIR__ . '/../config/route-attributes.php', 'route-attributes');
        Router::mixin(new RouteMixin);
    }

    protected function registerRoutes(): void
    {
        if (! config('route-attributes.enabled')) {
            return;
        }

        $routeRegistrar = (new RouteRegistrar(app()->router))
            ->useRootNamespace(app()->getNamespace())
            ->useMiddleware(config('route-attributes.middleware') ?? []);

        $testClassDirectory = __DIR__ . '/../tests/TestClasses';

        collect(app()->runningUnitTests() ? $testClassDirectory : config('route-attributes.directories'))
            ->each(fn (string $directory) => $routeRegistrar->registerDirectory($directory));
    }
}
