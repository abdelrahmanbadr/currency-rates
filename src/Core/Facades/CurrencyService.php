<?php

namespace Abdelrahman_badr\CurrencyRates\Core\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * Class CurrencyService
 * @package Abdelrahman_badr\CurrencyRates\Core\Facades
 */
class CurrencyService extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'CurrencyService';
    }
}
