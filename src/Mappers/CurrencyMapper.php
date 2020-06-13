<?php

namespace Abdelrahman_badr\CurrencyRates\Mappers;

use Abdelrahman_badr\CurrencyRates\Models\Currency;
use Abdelrahman_badr\CurrencyRates\Core\Contracts\CurrencyMapperInterface;
use Abdelrahman_badr\CurrencyRates\Exceptions\ResponseException;
use Exception;
use DateTime;
use stdClass;

/**
 * Class CurrencyMapper
 * @package Abdelrahman_badr\CurrencyRates\Mappers
 */
class CurrencyMapper implements CurrencyMapperInterface
{
    /**
     * @param stdClass $currency
     * @return Currency
     * @throws ResponseException
     */
    public function map(stdClass $currency): Currency
    {
        $currencyRate = new Currency();
        try {
            $currencyRate->base = $this->mapBase($currency->base);
            $currencyRate->rates = $this->mapRates($currency->rates);
        } catch (Exception $e) {
            throw  ResponseException::cannotMapResponse();
        }
        isset($currency->date) ? ($currencyRate->date = $this->mapDate($currency->date)) : null;
        isset($currency->start_at) ? ($currencyRate->startAt = $this->mapStartAt($currency->start_at)) : null;
        isset($currency->end_at) ? ($currencyRate->endAt = $this->mapEndAt($currency->end_at)) : null;
        return $currencyRate;
    }

    /**
     * @param string $base
     * @return string
     */
    private function mapBase(string $base)
    {
        return $base;
    }

    /**
     * @param stdClass $rates
     * @return stdClass
     */
    private function mapRates(stdClass $rates)
    {
        return $rates;
    }

    /**
     * @param string $date
     * @return DateTime
     */
    private function mapDate(string $date): DateTime
    {
        return new DateTime($date);
    }

    /**
     * @param string $start_at
     * @return DateTime
     */
    private function mapStartAt(string $start_at): DateTime
    {
        return new DateTime($start_at);
    }

    /**
     * @param string $end_at
     * @return DateTime
     */
    private function mapEndAt(string $end_at): DateTime
    {
        return new DateTime($end_at);
    }
}
