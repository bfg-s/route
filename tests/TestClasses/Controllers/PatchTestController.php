<?php

namespace Bfg\Route\Tests\TestClasses\Controllers;

use Bfg\Route\Attributes\Patch;

class PatchTestController
{
    #[Patch('my-patch-method')]
    public function myPatchMethod()
    {
    }
}
