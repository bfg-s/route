<?php

namespace Bfg\Route\Tests\TestClasses\Controllers;

use Bfg\Route\Attributes\Domain;
use Bfg\Route\Attributes\Get;
use Bfg\Route\Attributes\Post;

#[Domain('my-subdomain.localhost')]
class DomainTestController
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
