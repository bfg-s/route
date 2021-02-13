<?php

namespace Bfg\Route\Attributes;

use Attribute;

/**
 * Class Domain
 * @package Bfg\Route\Attributes
 */
#[Attribute(Attribute::TARGET_CLASS)]
class Domain implements RouteAttribute
{
    /**
     * Domain constructor.
     * @param  string  $domain
     */
    public function __construct(
        public string $domain
    ) {}
}
