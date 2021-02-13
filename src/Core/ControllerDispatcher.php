<?php

namespace Bfg\Route\Core;

use Illuminate\Routing\Contracts\ControllerDispatcher as ControllerDispatcherContract;
use Illuminate\Routing\Route;

class ControllerDispatcher extends \Illuminate\Routing\ControllerDispatcher implements ControllerDispatcherContract
{
    /**
     * Dispatch a request to a given controller and method.
     *
     * @param  \Illuminate\Routing\Route  $route
     * @param  mixed  $controller
     * @param  string  $method
     * @return mixed
     */
    public function dispatch(Route $route, $controller, $method)
    {
        return parent::dispatch($route, $controller, $method);

//        $parameters = $this->resolveClassMethodDependencies(
//            $route->parametersWithoutNulls(), $controller, $method
//        );
//
//        return embedded_call([$controller, $method], $parameters);
    }
}
