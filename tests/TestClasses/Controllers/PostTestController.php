<?php

namespace Bfg\Route\Tests\TestClasses\Controllers;

use Bfg\Route\Attributes\Post;

class PostTestController
{
    #[Post('my-post-method')]
    public function myPostMethod()
    {
    }
}
