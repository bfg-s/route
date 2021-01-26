<?php

namespace Bfg\Route\Tests\TestClasses\Controllers;

use Bfg\Route\Attributes\Put;

class PutTestController
{
    #[Put('my-put-method')]
    public function myPutMethod()
    {
    }
}
