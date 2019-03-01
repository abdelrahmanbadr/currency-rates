<?php

namespace Tests\CurrencyRate\Providers;

use Abdelrahman_badr\CurrencyRates\Providers\ExchangeRatesApiProvider;
use PHPUnit\Framework\TestCase;
use DateTime;

class ExchangeRatesApiProviderTest extends TestCase
{
    private $baseUrl;
    /**
     * @var ExchangeRatesApiProvider
     */
    private $provider;

    public function setup()
    {

        $this->baseUrl = env("EXCHANGE_RATES_API_URL", 'https://api.exchangeratesapi.io/');
        $this->provider = new ExchangeRatesApiProvider();
    }


    public function testLatest()
    {

        $base = "USD";
        $url = $this->provider->getLatestUrl($base);
        $expected = $this->baseUrl . "latest?base=" . $base;
        $this->assertEquals($url, $expected);

    }

    public function testHistorical()
    {

        $base = "EUR";
        $start = "2010-01-01";
        $end = "2011-01-01";
        $startDate = new DateTime($start);
        $endDate = new DateTime($end);

        $symbols = ["USD", "AUD"];
        $url = $this->provider->getHistoricalUrl($base, $startDate, $endDate, $symbols);
        $expected = $this->baseUrl . "history?base=" . $base . "&start_at=" . $start . "&end_at=" . $end . "&symbols=" . implode($symbols, ",");

        $this->assertEquals($url, $expected);

    }


}