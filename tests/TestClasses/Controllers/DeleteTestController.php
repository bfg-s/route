<?php

namespace Bfg\Route\Tests\TestClasses\Controllers;

use Bfg\Route\Attributes\Delete;

class DeleteTestController
{
    #[Delete('my-delete-method')]
    public function myDeleteMethod()
    {
    }
}
