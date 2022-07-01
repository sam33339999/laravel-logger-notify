<?php

namespace SaC\LoggerLineNotify;

use Illuminate\Support\Facades\Facade;

class LineNotifyFacade extends Facade
{
    /**
     * @return string
     */

    protected static function getFacadeAccessor(): string
    {
        return 'LineNotify';
    }
}