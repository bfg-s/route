<?php

namespace Bfg\Route;

use Illuminate\Support\Facades\Facade as FacadeIlluminate;

/**
 * Class Facade.
 * @package Bfg\Layout
 */
class Facade extends FacadeIlluminate
{
    /**
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return BfgRoute::class;
    }
}
