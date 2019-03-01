<?php

namespace Tests\Mappers\CurrencyRate;

use Tests\TestCase;
use CurrencyRate\Mappers\CurrencyMapper;

use stdClass,DateTime;

class CurrencyMapperTest extends TestCase
{

    public function dataProvider()
    {
        return [
            [
                "currency" => (object)[
                    "rates" => (object)[
                        "USD" => 1.1361,
                        "GBP" => 0.86055,
                    ],
                    "base" => "EUR",
                    "date" => "2019-02-26"
                ]


            ]
        ];
    }


    /**
     *  A basic test currency map function.
     * @param stdClass $currency
     * @throws \CurrencyRate\Exceptions\ResponseException
     * @dataProvider dataProvider
     * @return void
     */
    public function testCurrencyMap(stdClass $currency)
    {

        $mappedCurrency = (new CurrencyMapper())->map($currency);
        $this->assertEquals($currency->base, $mappedCurrency->base);
        $this->assertEquals($currency->rates, $mappedCurrency->rates);
        $this->assertEquals(new DateTime($currency->date), $mappedCurrency->date);



    }

}