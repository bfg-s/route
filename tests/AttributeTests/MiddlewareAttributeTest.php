<?php

namespace Bfg\Route\Tests\AttributeTests;

use Bfg\Route\Tests\TestCase;
use Bfg\Route\Tests\TestClasses\Controllers\middlewareTestController;
use Bfg\Route\Tests\TestClasses\middleware\OtherTestmiddleware;
use Bfg\Route\Tests\TestClasses\middleware\Testmiddleware;

class middlewareAttributeTest extends TestCase
{
    /** @test */
    public function it_can_apply_middleware_on_each_method_of_a_controller()
    {
        $this->routeRegistrar->registerClass(middlewareTestController::class);

        $this
            ->assertRegisteredRoutesCount(2)
            ->assertRouteRegistered(
                middlewareTestController::class,
                controllerMethod: 'singlemiddleware',
                uri: 'single-middleware',
                middleware: [Testmiddleware::class],
            )
            ->assertRouteRegistered(
                middlewareTestController::class,
                controllerMethod: 'multiplemiddleware',
                uri: 'multiple-middleware',
                middleware: [Testmiddleware::class, OtherTestmiddleware::class],
            );
    }
}
