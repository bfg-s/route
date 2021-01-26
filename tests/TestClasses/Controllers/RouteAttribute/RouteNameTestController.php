<?php

namespace Bfg\Route\Tests\TestClasses\Controllers\RouteAttribute;

use Bfg\Route\Attributes\Route;

class RouteNameTestController
{
    #[Route('get', 'my-method', name: 'test-name')]
    public function myMethod()
    {
    }
}
