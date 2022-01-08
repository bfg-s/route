<?php

namespace Bfg\Route;

use Bfg\Entity\ConfigFactory;

/**
 * CacheFactory store.
 * @package Bfg\Route
 */
class CacheFactory extends ConfigFactory
{
    /**
     * PermissionFactory constructor.
     */
    public function __construct()
    {
        parent::__construct(base_path('bootstrap/cache/route_attributes.php'));
    }
}
