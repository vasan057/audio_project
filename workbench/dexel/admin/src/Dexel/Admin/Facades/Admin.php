<?php namespace Dexel\Admin\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * The Admin facade.
 *
 * @package Dexel\Admin\Facades
 * @author Manikandan R <mani@dexeldesigns.com>
 */
class Admin extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'admin';
    }
}
