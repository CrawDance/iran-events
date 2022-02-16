<?php
/**
 * Developer: Keivan
 * E-mail: me@keiv.ir
 * Date:
 */


use CrawDance\IranEvents\IranEvents;

if (!function_exists('iran_events')) {
    /**
     * @param null $date
     * @return IranEvents
     * @throws Exception
     */
    function iran_events($date = null)
    {
        return new IranEvents($date);
    }
}
