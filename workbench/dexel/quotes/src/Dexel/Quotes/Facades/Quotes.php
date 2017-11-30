<?php namespace Dexel\Quotes\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * The Quotes facade.
 *
 * @package Dexel\Quotes\Facades
 * @author Manikandan R <mani@dexeldesigns.com>
 */
class Quotes extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'quotes';
    }
}
