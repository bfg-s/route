<?php

namespace Bfg\Route\Attributes;

use Attribute;

#[Attribute(Attribute::TARGET_METHOD)]
class Options extends Route
{
    public function __construct(
        string $uri,
        ?string $name = null,
        array|string $middleware = [],
    ) {
        parent::__construct(
            method: 'options',
            uri: $uri,
            name: $name,
            middleware: $middleware,
        );
    }
}
