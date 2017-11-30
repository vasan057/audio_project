<?php namespace Dexel\Audio\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * The Audio facade.
 *
 * @package Dexel\Audio\Facades
 * @author Manikandan R <mani@dexeldesigns.com>
 */
class Audio extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'audio';
    }
}
