<?php

namespace Bfg\Route\Tests\TestClasses\Controllers\RouteRegistrar;

use Bfg\Route\Attributes\Get;

class RegistrarTestSecondController
{
    #[Get('second-method')]
    public function myMethod()
    {
    }
}
