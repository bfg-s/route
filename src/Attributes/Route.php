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
     * @var array
     */
    public ?array $where;

    /**
     * Route constructor.
     * @param  string|array  $method
     * @param  string  $uri
     * @param  string|null  $name
     * @param  array|string  $middleware
     * @param  array|null  $where
     */
    public function __construct(
        public string|array $method,
        public string $uri,
        public ?string $name = null,
        array|string $middleware = [],
        array $where = null,
    ) {
        $this->middleware = Arr::wrap($middleware);
        $this->where = $where;
    }
}
