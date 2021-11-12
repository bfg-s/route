<?php

namespace Bfg\Route\Tests\TestClasses\Controllers;

use Bfg\Route\Attributes\Any;

/**
 * Class AnyTestController.
 * @package Bfg\Route\Tests\TestClasses\Controllers
 */
class AnyTestController
{
    #[Any('my-any-method')]
    public function myAnyMethod()
    {
    }
}
