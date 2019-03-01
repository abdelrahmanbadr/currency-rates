<?php

namespace Abdelrahman_badr\CurrencyRates\Core;

use Abdelrahman_badr\currencyRate\Services\ExcelService;
use Illuminate\Support\ServiceProvider;

use Abdelrahman_badr\CurrencyRates\Services\CurrencyService;
use Abdelrahman_badr\CurrencyRates\Providers\ExchangeRatesApiProvider;
use Abdelrahman_badr\CurrencyRates\Mappers\CurrencyMapper;
use Abdelrahman_badr\CurrencyRates\Services\Http\GuzzleHttpAdapter;


class CurrencyServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {

    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->instance('CurrencyService', new CurrencyService(new ExchangeRatesApiProvider(), new CurrencyMapper(), new GuzzleHttpAdapter(), new ExcelService()));
    }

}