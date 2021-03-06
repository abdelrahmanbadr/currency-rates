<?php

namespace Tests\CurrencyRate\Services;

use Abdelrahman_badr\CurrencyRates\Core\Contracts\HttpAdapterInterface;
use Abdelrahman_badr\CurrencyRates\Providers\ExchangeRatesApiProvider;
use Abdelrahman_badr\CurrencyRates\Services\CurrencyService;
use PHPUnit\Framework\TestCase;
use Abdelrahman_badr\CurrencyRates\Mappers\CurrencyMapper;
use Mockery;
use DateTime;

class CurrencyServiceTest extends TestCase
{
    private $provider;
    private $mapper;

    public function tearDown()
    {
        Mockery::close();
    }

    public function setup()
    {
        $this->provider = new ExchangeRatesApiProvider();
        $this->mapper = new CurrencyMapper();
    }

    public function testGetLatest()
    {
        $httpAdapter = Mockery::mock(HttpAdapterInterface::class);
        $httpAdapter->shouldReceive('getContent')
            ->with("https://api.exchangeratesapi.io/latest?base=EUR")
            ->andReturn('{"rates":{"USD":1.1416,"GBP":0.85835},"base":"EUR","date":"2019-02-28"}');
        $currencyService = new CurrencyService($this->provider, $this->mapper, $httpAdapter);
        $latestRates = (object)[
            "USD" => 1.1416,
            "GBP" => 0.85835,
        ];
        $result = $currencyService->getLatest("EUR");
        $this->assertEquals($result->base, "EUR");
        $this->assertEquals($result->date, new DateTime("2019-02-28"));
        $this->assertEquals($result->rates, $latestRates);
        $this->assertNull($result->startAt);
        $this->assertNull($result->endAt);
    }

    public function testGetHistorical()
    {
        $httpAdapter = Mockery::mock(HttpAdapterInterface::class);
        $httpAdapter->shouldReceive('getContent')
            ->with(
                "https://api.exchangeratesapi.io/history?base=AUD&start_at=2018-01-01&end_at=2018-01-03&symbols=USD,GBP"
            )
            ->andReturn(
                '{"rates":{"2018-01-02":{"USD":1.2065,"GBP":0.88953},"2018-01-03":{"USD":1.2023,"GBP":0.8864}},
                "end_at":"2018-01-03","base":"AUD","start_at":"2018-01-01"}'
            );
        $historicalRates = (object)[
            "2018-01-02" => (object)[
                "USD" => 1.2065,
                "GBP" => 0.88953,
            ],
            "2018-01-03" => (object)[
                "USD" => 1.2023,
                "GBP" => 0.8864,
            ],
        ];
        $currencyService = new CurrencyService($this->provider, $this->mapper, $httpAdapter);
        $result = $currencyService->getHistorical(
            new DateTime("2018-01-01"),
            new DateTime("2018-01-03"),
            "AUD",
            ["USD", "GBP"]
        );
        $this->assertEquals($result->base, "AUD");
        $this->assertEquals($result->rates, $historicalRates);
        $this->assertEquals($result->startAt, new DateTime("2018-01-01"));
        $this->assertEquals($result->endAt, new DateTime("2018-01-03"));
        $this->assertNull($result->date);
    }
}
