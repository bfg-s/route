<?php

namespace Bfg\Route\Tests\AttributeTests;

use Bfg\Route\Tests\TestCase;
use Bfg\Route\Tests\TestClasses\Controllers\OptionsTestController;

class OptionsAttributeTest extends TestCase
{
    /** @test */
    public function it_can_register_a_options_route()
    {
        $this->routeRegistrar->registerClass(OptionsTestController::class);

        $this
            ->assertRegisteredRoutesCount(1)
            ->assertRouteRegistered(OptionsTestController::class, 'myOptionsMethod', 'options', 'my-options-method');
    }
}
