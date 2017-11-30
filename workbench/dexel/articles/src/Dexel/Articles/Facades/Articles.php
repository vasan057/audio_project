<?php namespace Dexel\Articles\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * The Articles facade.
 *
 * @package Dexel\Articles\Facades
 * @author Manikandan R <mani@dexeldesigns.com>
 */
class Articles extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'articles';
    }
}
