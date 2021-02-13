<?php

namespace Bfg\Route\Attributes;

use Attribute;
use Illuminate\Support\Arr;

/**
 * Class Middleware
 * @package Bfg\Route\Attributes
 */
#[Attribute(Attribute::TARGET_CLASS)]
class Middleware implements RouteAttribute
{
    /**
     * @var array
     */
    public array $middleware = [];

    /**
     * Middleware constructor.
     * @param  string|array  $middleware
     */
    public function __construct(string|array $middleware = [])
    {
        $this->middleware = Arr::wrap($middleware);
    }
}
