<?php

namespace Bfg\Route\Tests\TestClasses\Controllers;

use Bfg\Route\Attributes\Get;

class GetTestController
{
    #[Get('my-get-method')]
    public function myGetMethod()
    {
    }
}
