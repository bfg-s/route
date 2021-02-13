<?php

namespace Bfg\Route\Attributes;

use Attribute;

/**
 * Class Prefix
 * @package Bfg\Route\Attributes
 */
#[Attribute(Attribute::TARGET_CLASS)]
class Prefix implements RouteAttribute
{
    /**
     * Prefix constructor.
     * @param  string  $prefix
     */
    public function __construct(
        public string $prefix
    ) {}
}
