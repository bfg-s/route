<?php

namespace Bfg\Route\Tests\TestClasses\Controllers\RouteAttribute;

use Bfg\Route\Attributes\Route;

class RouteGetTestController
{
    #[Route('get', 'my-get-method')]
    public function myGetMethod()
    {
    }
}
