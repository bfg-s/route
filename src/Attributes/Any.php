<?php

namespace Bfg\Route\Attributes;

use Attribute;

/**
 * Class Any
 * @package Bfg\Route\Attributes
 */
#[Attribute(Attribute::TARGET_METHOD)]
class Any extends Route
{
    /**
     * Any constructor.
     * @param  string  $uri
     * @param  string|null  $name
     * @param  array|string  $middleware
     */
    public function __construct(
        string $uri,
        ?string $name = null,
        array|string $middleware = [],
    ) {
        parent::__construct(
            method: 'any',
            uri: $uri,
            name: $name,
            middleware: $middleware,
        );
    }
}
