<?php

namespace Bfg\Route\Attributes;

use Attribute;

/**
 * Class Patch
 * @package Bfg\Route\Attributes
 */
#[Attribute(Attribute::TARGET_METHOD)]
class Patch extends Route
{
    /**
     * Patch constructor.
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
            method: 'patch',
            uri: $uri,
            name: $name,
            middleware: $middleware,
        );
    }
}
