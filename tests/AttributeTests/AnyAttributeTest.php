<?php

namespace Bfg\Route\Tests\AttributeTests;

use Bfg\Route\Tests\TestCase;
use Bfg\Route\Tests\TestClasses\Controllers\AnyTestController;

class AnyAttributeTest extends TestCase
{
    /** @test */
    public function it_can_register_an_any_route()
    {
        $this->routeRegistrar->registerClass(AnyTestController::class);

        $middleware = [
            "Bfg\Route\Tests\TestClasses\middleware\AnotherTestmiddleware"
        ];

        $this
            ->assertRegisteredRoutesCount(1)
            ->assertRouteRegistered(AnyTestController::class, 'myAnyMethod', 'head', 'my-any-method', $middleware)
            ->assertRouteRegistered(AnyTestController::class, 'myAnyMethod', 'get', 'my-any-method', $middleware)
            ->assertRouteRegistered(AnyTestController::class, 'myAnyMethod', 'post', 'my-any-method', $middleware)
            ->assertRouteRegistered(AnyTestController::class, 'myAnyMethod', 'put', 'my-any-method', $middleware)
            ->assertRouteRegistered(AnyTestController::class, 'myAnyMethod', 'patch', 'my-any-method', $middleware)
            ->assertRouteRegistered(AnyTestController::class, 'myAnyMethod', 'delete', 'my-any-method', $middleware)
            ->assertRouteRegistered(AnyTestController::class, 'myAnyMethod', 'options', 'my-any-method', $middleware);
    }
}
