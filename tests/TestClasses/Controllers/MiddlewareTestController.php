<?php

namespace Bfg\Route\Tests\TestClasses\Controllers;

use Bfg\Route\Attributes\middleware;
use Bfg\Route\Attributes\Route;
use Bfg\Route\Tests\TestClasses\middleware\OtherTestmiddleware;
use Bfg\Route\Tests\TestClasses\middleware\Testmiddleware;

#[middleware(Testmiddleware::class)]
class MiddlewareTestController
{
    #[Route('get', 'single-middleware')]
    public function singlemiddleware()
    {
    }

    #[Route('get', 'multiple-middleware', middleware: OtherTestmiddleware::class)]
    public function multiplemiddleware()
    {
    }
}
