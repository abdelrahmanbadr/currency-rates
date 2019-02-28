<?php

namespace Abdelrahman_badr\CurrencyRates\Core\Contracts;

use Abdelrahman_badr\CurrencyRates\Models\Currency;
use DateTime;

interface CurrencyServiceInterface
{
    /**
     * @return Currency
     */
    public function getLatest(): Currency;

    public function getHistorical(DateTime $startAt, DateTime $endAt): Currency;
}