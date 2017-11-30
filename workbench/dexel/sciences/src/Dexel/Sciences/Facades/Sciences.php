<?php namespace Dexel\Sciences\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * The Sciences facade.
 *
 * @package Dexel\Sciences\Facades
 * @author Manikandan R <mani@dexeldesigns.com>
 */
class Sciences extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'sciences';
    }
}
