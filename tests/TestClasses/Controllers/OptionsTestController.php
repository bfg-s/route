<?php

namespace Bfg\Route\Tests\TestClasses\Controllers;

use Bfg\Route\Attributes\Options;

class OptionsTestController
{
    #[Options('my-options-method')]
    public function myOptionsMethod()
    {
    }
}
