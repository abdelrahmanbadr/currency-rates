<?php

namespace Abdelrahman_badr\CurrencyRates\Services\Facades;

use Illuminate\Support\Facades\Facade;

class CurrencyService extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'CurrencyService';
    }
}