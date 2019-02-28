<?php

namespace Abdelrahman_badr\CurrencyRates\Providers;
use DateTime;


/**
 * Class ExchangeRatesApiProvider
 * @package Abdelrahman_badr\CurrencyRates\Providers
 */
class ExchangeRatesApiProvider extends AbstractProvider
{
    /**
     * set baseUri for exchange rates api
     * ExchangeRatesApiProvider constructor.
     * @return void
     */
    public function __construct()
    {
        //env('CURRENCY_EXCHANGE_API_URL', 'https://api.exchangeratesapi.io/latest');
        $this->baseUri = env("EXCHANGE_RATES_API_URL", 'https://api.exchangeratesapi.io/');
    }

    /**
     * {@inheritdoc}
     */
    public function getLatestUrl(string $base, array $symbols = []): string
    {
        $this->getBase($base);
        $this->getSymbols($symbols);
        $query = [];
        $query['base'] = $this->getBase($base);
        $symbols ? $query['symbols'] = $this->getSymbols($symbols) : null;
        return $this->buildUrl("latest", $query);
    }

    /**
     * {@inheritdoc}
     */
    public function getHistoricalUrl(string $base, DateTime $startAt, DateTime $endAt = null, array $symbols = [])
    {
        $this->getBase($base);

        $query = [];
        $query['base'] = $this->getBase($base);
        $query['start_at'] = $startAt->format('Y-m-d');
        $endAt ? ($query['end_at'] = $endAt->format('Y-m-d')) : ($query['end_at'] = $query['start_at']);
        $symbols ? $query['symbols'] = $this->getSymbols($symbols) : null;

        return $this->buildUrl("history", $query);
    }

    private function getBase(string $base): string
    {
        return strtoupper($base);

    }

    private function getSymbols(array $symbols): string
    {
        $upperSymbols = [];
        foreach ($symbols as $symbol) {
            $upperSymbols[] = strtoupper($symbol);
        }
        return implode($upperSymbols, ",");
    }


}