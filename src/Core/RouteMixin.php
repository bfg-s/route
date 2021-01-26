<?php

namespace Bfg\Route\Core;

use Bfg\Layout\Middleware\LayoutMiddleware;
use Bfg\Route\RouteRegistrar;
use Illuminate\Routing\Router;

/**
 * Class RouteMixin
 * @package Bfg\Route\Core
 * @mixin Router
 */
class RouteMixin
{
    /**
     * Attributable routs
     * @return \Closure
     */
    public function attributes() : \Closure
    {
        return function (string $dir) {

            $routeRegistrar = (new RouteRegistrar($this))
                ->useRootNamespace(app()->getNamespace());

            $routeRegistrar->registerDirectory($dir);
        };
    }
}