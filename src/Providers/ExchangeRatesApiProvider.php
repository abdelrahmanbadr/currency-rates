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
        $this->baseUri = env("EXCHANGE_RATES_API_URL", 'https://api.exchangeratesapi.io/');
    }

    /**
     * {@inheritdoc}
     */
    public function getLatestUrl(string $base, array $symbols = []): string
    {
        $query = [];
        $query['base'] = $this->sanitizeBase($base);
        $symbols ? $query['symbols'] = $this->sanitizeSymbols($symbols) : null;
        return $this->buildUrl("latest", $query);
    }

    /**
     * {@inheritdoc}
     */
    public function getHistoricalUrl(string $base, DateTime $startAt, DateTime $endAt = null, array $symbols = [])
    {
        $query = [];
        $query['base'] = $this->sanitizeBase($base);
        $query['start_at'] = $startAt->format('Y-m-d');
        $endAt ? ($query['end_at'] = $endAt->format('Y-m-d')) : ($query['end_at'] = $query['start_at']);
        $symbols ? $query['symbols'] = $this->sanitizeSymbols($symbols) : null;

        return $this->buildUrl("history", $query);
    }

    private function sanitizeBase(string $base): string
    {
        return strtoupper($base);

    }

    private function sanitizeSymbols(array $symbols): string
    {
        $upperSymbols = [];
        foreach ($symbols as $symbol) {
            $upperSymbols[] = strtoupper($symbol);
        }
        return implode($upperSymbols, ",");
    }


}