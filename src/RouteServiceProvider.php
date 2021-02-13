<?php

namespace Bfg\Route;

use Bfg\Route\Core\ControllerDispatcher;
use Bfg\Route\Core\RouteMixin;
use Illuminate\Routing\Contracts\ControllerDispatcher as ControllerDispatcherContract;
use Illuminate\Routing\Router;
use Illuminate\Support\ServiceProvider;

/**
 * Class RouteServiceProvider
 * @package Bfg\Route
 */
class RouteServiceProvider extends ServiceProvider
{
    /**
     * Enable state
     * Not switch, only for cache
     * @var bool
     */
    protected static bool $enabled = false;

    /**
     * Register route settings
     * @throws \ReflectionException
     */
    public function register()
    {
        /**
         * Checks if there is a cache file for the route,
         * if the file exists, scanning is disabled
         */
        static::$enabled = !app()->routesAreCached();

        /**
         * Make route mixins
         */
        Router::mixin(new RouteMixin);

        /**
         * Experimental function
         */
//        $this->app->extend(ControllerDispatcherContract::class, function () {
//            return new ControllerDispatcher(app());
//        });
    }

    /**
     * Enable state getter
     * @return bool
     */
    public static function isEnabled()
    {
        return static::$enabled;
    }
}
