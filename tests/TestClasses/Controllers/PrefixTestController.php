<?php

namespace Bfg\Route\Tests\TestClasses\Controllers;

use Bfg\Route\Attributes\Get;
use Bfg\Route\Attributes\Post;
use Bfg\Route\Attributes\Prefix;

#[Prefix('my-prefix')]
class PrefixTestController
{
    #[Get('my-get-method')]
    public function myGetMethod()
    {
    }

    #[Post('my-post-method')]
    public function myPostMethod()
    {
    }
}
