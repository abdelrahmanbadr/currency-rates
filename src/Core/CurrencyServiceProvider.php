<?php

namespace Abdelrahman_badr\CurrencyRates\Core;

use Illuminate\Support\ServiceProvider;

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
        //CurrencyService

        $this->app->singleton('Abdelrahman_badr\CurrencyRates\Core\Contracts\CurrencyMapperInterface', 'Abdelrahman_badr\CurrencyRates\Mappers\CurrencyMapper');
        $this->app->singleton('Abdelrahman_badr\CurrencyRates\Core\Contracts\CurrencyProviderInterface', 'Abdelrahman_badr\CurrencyRates\Providers\ExchangeRatesApiProvider');
        $this->app->singleton('Abdelrahman_badr\CurrencyRates\Core\Contracts\CurrencyServiceInterface', 'Abdelrahman_badr\CurrencyRates\Services\CurrencyService');
        $this->app->singleton('Abdelrahman_badr\CurrencyRates\Core\Contracts\HttpAdapterInterface', 'Abdelrahman_badr\CurrencyRates\Services\Http\GuzzleHttpAdapter');
        $this->app->instance('CurrencyService', 'Abdelrahman_badr\CurrencyRates\Core\Facades\CurrencyService');
    }

}