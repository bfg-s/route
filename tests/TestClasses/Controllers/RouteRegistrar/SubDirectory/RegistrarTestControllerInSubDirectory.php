<?php

namespace Bfg\Route\Tests\TestClasses\Controllers\RouteRegistrar\SubDirectory;

use Bfg\Route\Attributes\Get;

class RegistrarTestControllerInSubDirectory
{
    #[Get('in-sub-directory')]
    public function myMethod()
    {
    }
}
