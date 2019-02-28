<?php

namespace Abdelrahman_badr\CurrencyRate\Core\Contracts;

use Abdelrahman_badr\CurrencyRate\Models\Currency;
use DateTime;

interface CurrencyServiceInterface
{
    /**
     * @return Currency
     */
    public function getLatest(): Currency;

    public function getHistorical(DateTime $startAt, DateTime $endAt): Currency;
}