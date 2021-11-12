<?php

namespace Bfg\Route\Attributes;

use Attribute;

/**
 * Class Any.
 * @package Bfg\Route\Attributes
 */
#[Attribute(Attribute::TARGET_CLASS)]
class Resource extends Route
{
    /**
     * Any constructor.
     * @param  string  $uri
     * @param  array|string  $middleware
     * @param  array|null  $where
     */
    public function __construct(
        string $uri,
        array|string $middleware = [],
        array $where = null,
    ) {
        parent::__construct(
            method: 'any',
            uri: $uri,
            name: $uri,
            middleware: $middleware,
            where: $where
        );
    }
}
