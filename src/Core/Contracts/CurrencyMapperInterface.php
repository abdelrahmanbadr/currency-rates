<?php

namespace Abdelrahman_badr\CurrencyRates\Core\Contracts;

use Abdelrahman_badr\CurrencyRates\Models\Currency;
use stdClass;

/**
 * Interface CurrencyMapperInterface
 * @package Abdelrahman_badr\CurrencyRates\Core\Contracts
 */
interface CurrencyMapperInterface
{
    /**
     * @param stdClass $currency
     * @return Currency
     */
    public function map(stdClass $currency): Currency;
}