<?php

namespace Bfg\Route\Core;

use Bfg\Route\BfgRoute;
use Illuminate\Routing\Route;
use Illuminate\Routing\Router;
use Illuminate\Routing\RouteRegistrar as RouteRegistrarIlluminate;

/**
 * Class RouteMixin.
 * @package Bfg\Route\Core
 * @mixin Router
 */
class RouteMixin
{
    /**
     * Attributable routs.
     * @return \Closure
     */
    public function find() : \Closure
    {
        /**
         * @param $dir
         * @param  Route|RouteRegistrarIlluminate  $router
         * @return Route|RouteRegistrarIlluminate
         */
        return function ($dir, $router = null) {
            /** @var Router $this */
            return (new BfgRoute($this))->find($dir, $router);
        };
    }
}
