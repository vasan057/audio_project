<?php namespace Dexel\Videos\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * The Videos facade.
 *
 * @package Dexel\Videos\Facades
 * @author Manikandan R <mani@dexeldesigns.com>
 */
class Videos extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'videos';
    }
}
