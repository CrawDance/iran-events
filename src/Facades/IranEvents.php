<?php
/**
 * Developer: Keivan
 * E-mail: me@keiv.ir
 * Date:
 */

namespace CrawDance\IranEvents\Facades;


use Illuminate\Support\Facades\Facade;

class IranEvents extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */

    protected static function getFacadeAccessor()
    {
        return 'iranevents';
    }
}
