<?php

namespace Bfg\Route\Tests;

use Arr;
use Illuminate\Routing\Route;
use Illuminate\Routing\RouteCollection;
use Orchestra\Testbench\TestCase as Orchestra;
use Bfg\Route\RouteServiceProvider;
use Bfg\Route\RouteRegistrar;
use Bfg\Route\Tests\TestClasses\middleware\AnotherTestmiddleware;
use Bfg\Route\Tests\TestClasses\middleware\OtherTestmiddleware;

class TestCase extends Orchestra
{
    protected RouteRegistrar $routeRegistrar;

    public function setUp(): void
    {
        parent::setUp();

//        $this->routeRegistrar = (new RouteRegistrar($router))
//            ->useBasePath($this->getTestPath())
//            ->useMiddleware([AnotherTestmiddleware::class])
//            ->useRootNamespace('Bfg\Route\Tests\\');

        $this->routeRegistrar = new RouteRegistrar(
            app()->router
                ->prefix($this->getTestPath())
                ->namespace('Bfg\Route\Tests\\')
                ->middleware([AnotherTestmiddleware::class])
        );
    }

    protected function getPackageProviders($app)
    {
        return [
            RouteServiceProvider::class,
        ];
    }

    public function getTestPath(string $directory = null): string
    {
        return __DIR__ . ($directory ? '/' . $directory : '');
    }

    public function assertRegisteredRoutesCount(int $expectedNumber): self
    {
        $actualNumber = $this->getRouteCollection()->count();

        $this->assertEquals($expectedNumber, $actualNumber);

        return $this;
    }

    public function assertRouteRegistered(
        string $controller,
        string $controllerMethod = 'myMethod',
        string $httpMethod = 'get',
        string $uri = 'my-method',
        string|array $middleware = [],
        string $name = null,
        string $domain = null,
        bool $dump = false,
    ): self {
        if (! is_array($middleware)) {
            $middleware = Arr::wrap($middleware);
        }

        $routeRegistered = collect($this->getRouteCollection()->getRoutes())
            ->contains(function (Route $route) use ($name, $middleware, $controllerMethod, $controller, $uri, $httpMethod, $domain, $dump) {

                if ($name === null) {

                    $name = RouteRegistrar::generate_name($uri);
                }

                if (! in_array(strtoupper($httpMethod), $route->methods)) {
                    return false;
                }

                if (str_replace(trim(__DIR__, '/') . '/', '', $route->uri()) !== $uri) {
                    return false;
                }

                if (get_class($route->getController()) !== $controller) {
                    return false;
                }

                if ($route->getActionMethod() !== $controllerMethod) {
                    return false;
                }

                if (array_diff($route->middleware(), $middleware)) {
                    return false;
                }

                if ($route->getName() !== $name) {
                    return false;
                }

                if ($route->getDomain() !== $domain) {
                    return false;
                }

                return true;
            });

        $this->assertTrue($routeRegistered, 'The expected route was not registered');

        return $this;
    }

    protected function getRouteCollection(): RouteCollection
    {
        return app()->router->getRoutes();
    }
}
