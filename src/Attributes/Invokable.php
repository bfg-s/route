<?php

namespace Bfg\Route\Attributes;

use Attribute;
use Illuminate\Support\Arr;

/**
 * Class Invokable.
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
     * @param  array|null  $where
     */
    public function __construct(
        public string $uri,
        public string | array $method = ['GET', 'HEAD', 'POST'],
        public ?string $name = null,
        public ?string $responsible = null,
        array|string $middleware = [],
        public ?array $where = null,
    ) {
        $this->middleware = Arr::wrap($middleware);
    }

    /**
     * @param  string  $class
     * @return string
     */
    public function class_replacer(string $class): string
    {
        return $class;
    }

    /**
     * @param  string  $class
     */
    public function before_add(string $class)
    {
    }
}
