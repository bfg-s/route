<?php

namespace Bfg\Route\Attributes;

use Attribute;

/**
 * Class Post
 * @package Bfg\Route\Attributes
 */
#[Attribute(Attribute::TARGET_METHOD)]
class Post extends Route
{
    /**
     * Post constructor.
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
            method: 'post',
            uri: $uri,
            name: $name,
            middleware: $middleware,
            where: $where
        );
    }
}
