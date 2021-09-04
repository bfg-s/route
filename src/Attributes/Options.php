<?php

namespace Bfg\Route\Attributes;

use Attribute;

/**
 * Class Options
 * @package Bfg\Route\Attributes
 */
#[Attribute(Attribute::TARGET_METHOD)]
class Options extends Route
{
    /**
     * Options constructor.
     * @param  string  $uri
     * @param  string|null  $name
     * @param  array|string  $middleware
     * @param  array|null  $where
     */
    public function __construct(
        string $uri,
        ?string $name = null,
        array|string $middleware = [],
        array $where = null,
    ) {
        parent::__construct(
            method: 'options',
            uri: $uri,
            name: $name,
            middleware: $middleware,
            where: $where
        );
    }
}
