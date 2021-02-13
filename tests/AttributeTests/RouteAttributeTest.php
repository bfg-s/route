<?php

namespace Bfg\Route\Tests\AttributeTests;

use Bfg\Route\Tests\TestCase;
use Bfg\Route\RouteRegistrar;
use Bfg\Route\Tests\TestClasses\Controllers\RouteAttribute\InvokableRouteGetTestController;
use Bfg\Route\Tests\TestClasses\Controllers\RouteAttribute\RouteGetTestController;
use Bfg\Route\Tests\TestClasses\Controllers\RouteAttribute\RoutemiddlewareTestController;
use Bfg\Route\Tests\TestClasses\Controllers\RouteAttribute\RoutePostTestController;
use Bfg\Route\Tests\TestClasses\Controllers\RouteAttribute\RouteNameTestController;
use Bfg\Route\Tests\TestClasses\middleware\Testmiddleware;

class RouteAttributeTest extends TestCase
{
    protected RouteRegistrar $routeRegistrar;

    /** @test */
    public function the_route_annotation_can_register_a_get_route_()
    {
        $this->routeRegistrar->registerClass(RouteGetTestController::class);

        $this
            ->assertRegisteredRoutesCount(1)
            ->assertRouteRegistered(
                RouteGetTestController::class,
                'myGetMethod',
                'get',
                'my-get-method',
                ["Bfg\Route\Tests\TestClasses\middleware\AnotherTestmiddleware"]
            );
    }

    /** @test */
    public function the_route_annotation_can_register_a_post_route()
    {
        $this->routeRegistrar->registerClass(RoutePostTestController::class);

        $this
            ->assertRegisteredRoutesCount(1)
            ->assertRouteRegistered(
                RoutePostTestController::class,
                'myPostMethod',
                'post',
                'my-post-method',
                ["Bfg\Route\Tests\TestClasses\middleware\AnotherTestmiddleware"]
            );
    }

    /** @test */
    public function it_can_add_middleware_to_a_method()
    {
        $this->routeRegistrar->registerClass(RoutemiddlewareTestController::class);

        $this->assertRouteRegistered(
            controller: RoutemiddlewareTestController::class,
            middleware: [Testmiddleware::class, "Bfg\Route\Tests\TestClasses\middleware\AnotherTestmiddleware"],
        );
    }

    /** @test */
    public function it_can_add_a_route_name_to_a_method()
    {
        $this->routeRegistrar->registerClass(RouteNameTestController::class);

        $this->assertRouteRegistered(
            controller: RouteNameTestController::class,
            middleware: ["Bfg\Route\Tests\TestClasses\middleware\AnotherTestmiddleware"],
            name: 'test-name'
        );
    }

    /** @test */
    public function it_can_add_a_route_for_an_invokable()
    {
        $this->routeRegistrar->registerClass(InvokableRouteGetTestController::class);

        $this
            ->assertRegisteredRoutesCount(1)
            ->assertRouteRegistered(
            controller: InvokableRouteGetTestController::class,
            controllerMethod: '__invoke',
            uri: 'my-invokable-route',
            middleware: ["Bfg\Route\Tests\TestClasses\middleware\AnotherTestmiddleware"]
        );
    }
}
