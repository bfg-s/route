<?php

namespace Bfg\Route\Attributes;

use Attribute;

/**
 * Class Put
 * @package Bfg\Route\Attributes
 */
#[Attribute(Attribute::TARGET_METHOD)]
class Put extends Route
{
    /**
     * Put constructor.
     * @param  string  $uri
     * @param  string|null  $name
     * @param  array|string  $middleware
     */
    public function __construct(
        string $uri,
        ?string $name = null,
        array|string $middleware = [],
        array $where = null,
    ) {
        parent::__construct(
            method: 'put',
            uri: $uri,
            name: $name,
            middleware: $middleware,
            where: $where
        );
    }
}
