<?php

namespace Bfg\Route\Attributes;

use Attribute;
use Illuminate\Support\Arr;

/**
 * Class Invokable
 * @package Bfg\Route\Attributes
 */
#[Attribute(Attribute::TARGET_CLASS)]
class Invokable implements RouteAttribute
{
    /**
     * @var array|string
     */
    public array|string $middleware = [];

    /**
     * Invokable constructor.
     * @param  string  $uri
     * @param  string|array  $method
     * @param  string|null  $name
     * @param  string|null  $responsible
     * @param  array|string  $middleware
     */
    public function __construct(
        public string $uri,
        public string|array $method = ['GET', 'HEAD', 'POST'],
        public ?string $name = null,
        public ?string $responsible = null,
        array|string $middleware = [],
    ) {
        $this->middleware = Arr::wrap($middleware);
    }
}
