<?php namespace Dexel\Contact\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * The Contact facade.
 *
 * @package Dexel\Contact
 * @author  Manikandan R <mani@dexeldesigns.com>
 */
class Contact extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'contact';
    }
}
