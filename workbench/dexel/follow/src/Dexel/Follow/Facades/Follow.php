<?php namespace Dexel\Follow\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * The Follow facade.
 *
 * @package Dexel\Follow
 * @author  Manikandan R <mani@dexeldesigns.com>
 */
class Follow extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'follow';
    }
}
