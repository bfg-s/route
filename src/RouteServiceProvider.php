<?php

namespace Bfg\Route;

use Bfg\Installer\Providers\InstalledProvider;
use Bfg\Route\Core\RouteMixin;
use Illuminate\Routing\Router;

/**
 * Class RouteServiceProvider
 * @package Bfg\Route
 */
class RouteServiceProvider extends InstalledProvider
{
    /**
     * Enable state
     * Not switch, only for cache
     * @var bool
     */
    protected static bool $enabled = false;

    /**
     * The description of extension.
     * @var string|null
     */
    public ?string $description = "PHP 8 attributes to register routes in a Laravel";

    /**
     * Set as installed by default.
     * @var bool
     */
    public bool $installed = true;

    /**
     * Executed when the provider is registered
     * and the extension is installed.
     * @return void
     * @throws \ReflectionException
     */
    function installed(): void
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
     * Executed when the provider run method
     * "boot" and the extension is installed.
     * @return void
     */
    function run(): void
    {
        //
    }

    /**
     * Enable state getter
     * @return bool
     */
    public static function isEnabled(): bool
    {
        return static::$enabled;
    }
}
