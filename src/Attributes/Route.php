<?php

namespace Bfg\Route\Attributes;

use Illuminate\Support\Arr;
use Attribute;

/**
 * Class Route
 * @package Bfg\Route\Attributes
 */
#[Attribute(Attribute::TARGET_METHOD)]
class Route implements RouteAttribute
{
    /**
     * @var array
     */
    public array $middleware;

    /**
     * Route constructor.
     * @param  string|array  $method
     * @param  string  $uri
     * @param  string|null  $name
     * @param  array|string  $middleware
     */
    public function __construct(
        public string|array $method,
        public string $uri,
        public ?string $name = null,
        array|string $middleware = [],
    ) {
        $this->middleware = Arr::wrap($middleware);
    }
}
