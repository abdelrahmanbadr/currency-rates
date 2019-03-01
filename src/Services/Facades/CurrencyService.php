<?php

namespace Abdelrahman_badr\Services\CurrencyRates\Facades;

use Illuminate\Support\Facades\Facade;

class CurrencyService extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'CurrencyService';
    }
}