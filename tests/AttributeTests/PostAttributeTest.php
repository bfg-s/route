<?php

namespace Bfg\Route\Tests\AttributeTests;

use Bfg\Route\Tests\TestCase;
use Bfg\Route\Tests\TestClasses\Controllers\PostTestController;

class PostAttributeTest extends TestCase
{
    /** @test */
    public function it_can_register_a_post_route()
    {
        $this->routeRegistrar->registerClass(PostTestController::class);

        $this
            ->assertRegisteredRoutesCount(1)
            ->assertRouteRegistered(
                PostTestController::class,
                'myPostMethod',
                'post',
                'my-post-method',
                ["Bfg\Route\Tests\TestClasses\middleware\AnotherTestmiddleware"]
            );
    }
}
