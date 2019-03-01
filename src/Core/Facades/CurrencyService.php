<?php

namespace Abdelrahman_badr\CurrencyRates\Core\Facades;

use Illuminate\Support\Facades\Facade;

class CurrencyService extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'CurrencyService';
    }
}