<?php

namespace Bfg\Route\Tests\TestClasses\Controllers\RouteAttribute;

use Bfg\Route\Attributes\Route;

class InvokableRouteGetTestController
{
    #[Route('get', 'my-invokable-route')]
    public function __invoke()
    {
    }
}
