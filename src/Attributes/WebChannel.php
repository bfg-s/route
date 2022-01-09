<?php

namespace Bfg\Route\Attributes;

use Attribute;
use Illuminate\Support\Arr;

/**
 * Class WebChannel.
 * @package Bfg\Route\Attributes
 */
#[Attribute(Attribute::TARGET_CLASS)]
class WebChannel implements RouteAttribute
{
    /**
     * @param  string|array|null  $channel
     * @param  string|array  $guard
     */
    public function __construct(
        public string | array | null $channel = null,
        public string | array $guard = "web",
    ) {}
}
