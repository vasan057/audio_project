<?php namespace Dexel\User\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * The User facade.
 *
 * @package Dexel\User\Facades
 * @author Manikandan R <mani@dexeldesigns.com>
 */
class User extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'user';
    }
}
