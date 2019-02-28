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
        $this->app->singleton('CurrencyRates\Core\Contracts\CurrencyMapperInterface', 'CurrencyRates\Mappers\CurrencyMapper');
        $this->app->singleton('CurrencyRates\Core\Contracts\CurrencyProviderInterface', 'CurrencyRates\Providers\ExchangeRatesApiProvider');
        $this->app->singleton('CurrencyRates\Core\Contracts\CurrencyServiceInterface', 'CurrencyRates\Services\CurrencyService');
        $this->app->singleton('CurrencyRates\Core\Contracts\HttpAdapterInterface', 'CurrencyRates\Services\Http\GuzzleHttpAdapter');

    }

}