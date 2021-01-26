<?php

namespace Bfg\Route\Tests\AttributeTests;

use Bfg\Route\Tests\TestCase;
use Bfg\Route\Tests\TestClasses\Controllers\PatchTestController;

class PatchAttributeTest extends TestCase
{
    /** @test */
    public function it_can_register_a_patch_route()
    {
        $this->routeRegistrar->registerClass(PatchTestController::class);

        $this
            ->assertRegisteredRoutesCount(1)
            ->assertRouteRegistered(PatchTestController::class, 'myPatchMethod', 'patch', 'my-patch-method');
    }
}
