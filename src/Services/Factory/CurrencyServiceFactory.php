<?php

namespace Abdelrahman_badr\CurrencyRate\Services\Factory;

use Abdelrahman_badr\CurrencyRates\Services\CurrencyService;
use Abdelrahman_badr\CurrencyRates\Services\Http\GuzzleHttpAdapter;
use Abdelrahman_badr\CurrencyRates\Mappers\CurrencyMapper;
use Abdelrahman_badr\CurrencyRates\Providers\ExchangeRatesApiProvider;

class CurrencyServiceFactory
{
    public function make()
    {
        return new CurrencyService(new ExchangeRatesApiProvider(), new CurrencyMapper(), new GuzzleHttpAdapter());

    }
}