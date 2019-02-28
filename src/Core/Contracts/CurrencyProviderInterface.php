<?php

namespace Abdelrahman_badr\CurrencyRates\Core\Contracts;

use DateTime;

/**
 * Interface CurrencyProviderInterface
 * @package Abdelrahman_badr\CurrencyRates\Core\Contracts
 */
interface CurrencyProviderInterface
{
    /**
     * Get latest exchange rates.
     *
     * @param  string $base
     * @param  array $symbols
     * @return string
     */
    public function getLatestUrl(string $base, array $symbols): string;

    /**
     * Get historical  exchange rates.
     * @param  string $base
     * @param  DateTime $startAt
     * @param  DateTime $endAt
     * @param  array $symbols
     * @return string
     */
    public function getHistoricalUrl(string $base, DateTime $startAt, DateTime $endAt, array $symbols);


}