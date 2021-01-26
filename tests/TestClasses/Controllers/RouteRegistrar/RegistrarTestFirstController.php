<?php

namespace Bfg\Route\Tests\TestClasses\Controllers\RouteRegistrar;

use Bfg\Route\Attributes\Get;

class RegistrarTestFirstController
{
    #[Get('first-method')]
    public function myMethod()
    {
    }
}
