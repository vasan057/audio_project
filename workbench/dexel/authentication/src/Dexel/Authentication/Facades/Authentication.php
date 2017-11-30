<?php namespace Dexel\Authentication\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * The Authentication facade.
 *
 * @package Dexel\Authentication\Facades
 * @author Manikandan R <mani@dexeldesigns.com>
 */
class Authentication extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'authentication';
    }
}
