<?php

namespace Bfg\Route\Tests\TestClasses\middleware;

use Closure;
use Illuminate\Http\Request;

class Testmiddleware
{
    public function handle(Request $request, Closure $next)
    {
        return $next($request);
    }
}
