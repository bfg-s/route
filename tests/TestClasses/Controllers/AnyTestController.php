<?php

namespace Bfg\Route\Tests\TestClasses\Controllers;

use Bfg\Route\Attributes\Any;

class AnyTestController
{
    #[Any('my-any-method')]
    public function myAnyMethod()
    {
    }
}
