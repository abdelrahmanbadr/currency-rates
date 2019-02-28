<?php

namespace Abdelrahman_badr\CurrencyRate\Core;

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
        $this->app->singleton('CurrencyRate\Core\Contracts\CurrencyMapperInterface', 'CurrencyRate\Mappers\CurrencyMapper');
        $this->app->singleton('CurrencyRate\Core\Contracts\CurrencyProviderInterface', 'CurrencyRate\Providers\ExchangeRatesApiProvider');
        $this->app->singleton('CurrencyRate\Core\Contracts\CurrencyServiceInterface', 'CurrencyRate\Services\CurrencyService');
        $this->app->singleton('CurrencyRate\Core\Contracts\HttpAdapterInterface', 'CurrencyRate\Services\Http\GuzzleHttpAdapter');

    }

}