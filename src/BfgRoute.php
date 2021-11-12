<?php

namespace Bfg\Route;

use Illuminate\Routing\Router;

/**
 * Class BfgRoute.
 * @package Bfg\Route
 */
class BfgRoute
{
    public function __construct(
        protected Router $router
    ) {
    }

    /**
     * Find routers in controller classes.
     * @param  string  $path  Path for search attributes, you can use class namespaces, directories and file paths
     * @param  \Illuminate\Routing\RouteRegistrar  $registrar
     * @return \Illuminate\Routing\Route|\Illuminate\Routing\RouteRegistrar
     * @throws \ReflectionException
     */
    public function find(
        string|array $path,
        \Illuminate\Routing\Route|\Illuminate\Routing\RouteRegistrar $registrar = null
    ) {
        $routeRegistrar = (new RouteRegistrar($registrar ?? $this->router));

        if (RouteServiceProvider::isEnabled()) {
            if (is_array($path)) {
                foreach ($path as $item) {
                    $this->find($item, $registrar ?? $this->router);
                }
            } else {
                if (is_dir($path)) {
                    $routeRegistrar->registerDirectory($path);
                } elseif (is_file($path)) {
                    $routeRegistrar->registerFile($path);
                } elseif (class_exists($path)) {
                    $routeRegistrar->registerClass($path);
                }
            }
        }

        return $routeRegistrar->route;
    }
}
