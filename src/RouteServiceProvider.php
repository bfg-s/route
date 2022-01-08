<?php

namespace Bfg\Route;

use Illuminate\Support\ServiceProvider as IlluminateServiceProvider;
use Bfg\Route\Core\RouteMixin;
use Illuminate\Routing\Router;

/**
 * Class RouteServiceProvider.
 * @package Bfg\Route
 */
class RouteServiceProvider extends IlluminateServiceProvider
{
    /**
     * Enable state
     * Not switch, only for cache.
     * @var bool
     */
    protected static bool $enabled = false;

    /**
     * Register route settings.
     * @return void
     * @throws \ReflectionException
     */
    public function register()
    {
        /**
         * Checks if there is a cache file for the route,
         * if the file exists, scanning is disabled.
         */
        static::$enabled = ! app()->routesAreCached()
            || ! is_file(base_path('bootstrap/cache/route_attributes.php'));

        /**
         * Make route mixins.
         */
        Router::mixin(new RouteMixin);

        $this->app->singleton(CacheFactory::class, fn () => new CacheFactory);

        /**
         * Experiment for future.
         */
//        $this->app->extend(ControllerDispatcherContract::class, function () {
//            return new ControllerDispatcher(app());
//        });
    }

    public function boot()
    {
        $cacheFactory = app(CacheFactory::class);
        foreach ($cacheFactory->get('channels', []) as $class => $channel) {
            \Broadcast::channel($channel['channel'],$class,['guards'=>$channel['guard']]);
        }
    }

    /**
     * Enable state getter.
     * @return bool
     */
    public static function isEnabled(): bool
    {
        return static::$enabled;
    }
}
