<?php

namespace Bfg\Route\Tests\TestClasses\Controllers\RouteAttribute;

use Bfg\Route\Attributes\Route;
use Bfg\Route\Tests\TestClasses\middleware\Testmiddleware;

class RoutemiddlewareTestController
{
    #[Route('get', 'my-method', middleware: Testmiddleware::class)]
    public function myMethod()
    {
    }
}
