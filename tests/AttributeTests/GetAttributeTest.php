<?php

namespace Bfg\Route\Tests\AttributeTests;

use Bfg\Route\Tests\TestCase;
use Bfg\Route\Tests\TestClasses\Controllers\GetTestController;

class GetAttributeTest extends TestCase
{
    /** @test */
    public function it_can_register_a_get_route()
    {
        $this->routeRegistrar->registerClass(GetTestController::class);

        $this
            ->assertRegisteredRoutesCount(1)
            ->assertRouteRegistered(
                GetTestController::class,
                'myGetMethod',
                'get',
                'my-get-method',
                ["Bfg\Route\Tests\TestClasses\middleware\AnotherTestmiddleware"]
            );
    }
}
