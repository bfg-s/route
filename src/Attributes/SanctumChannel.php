<?php

namespace Bfg\Route\Attributes;

use Attribute;
use Illuminate\Support\Arr;

/**
 * Class SanctumChannel.
 * @package Bfg\Route\Attributes
 */
#[Attribute(Attribute::TARGET_CLASS)]
class SanctumChannel extends WebChannel
{
    /**
     * @param  string|array|null  $channel
     * @param  string|array  $guard
     */
    public function __construct(
        public string | array | null $channel = null,
        public string | array $guard = "sanctum",
    ) {}
}
