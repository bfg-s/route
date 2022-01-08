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
        if (is_array($path)) {
            $last = null;
            foreach ($path as $item) {
                $last = $this->find($item, $registrar ?? $this->router);
            }
            return $last ?: (new RouteRegistrar($registrar ?? $this->router))->route;
        }

        $routeRegistrar = (new RouteRegistrar($registrar ?? $this->router));

        $cacheFactory = app(CacheFactory::class);

        if (RouteServiceProvider::isEnabled()) {

            if (is_dir($path)) {
                $routeRegistrar->registerDirectory($path);
            } elseif (is_file($path)) {
                $routeRegistrar->registerFile($path);
            } elseif (class_exists($path)) {
                $routeRegistrar->registerClass($path);
            }

            $channels = array_merge(
                $cacheFactory->get('channels', []),
                $routeRegistrar->channels
            );

            $channels = array_filter(
                $channels,
                'class_exists',
                ARRAY_FILTER_USE_KEY
            );

            $cacheFactory
                ->set('channels', $channels)
                ->save();
        } else {

            $channels = $cacheFactory->get('channels');
        }

        foreach ($channels as $class => $channel) {

            \Broadcast::channel($channel['channel'],$class,['guards'=>$channel['guard']]);
        }

        return $routeRegistrar->route;
    }
}
