<?php

namespace Bfg\Route\Tests\TestClasses\Controllers\RouteAttribute;

use Bfg\Route\Attributes\Route;

class RoutePostTestController
{
    #[Route('post', 'my-post-method')]
    public function myPostMethod()
    {
    }
}
