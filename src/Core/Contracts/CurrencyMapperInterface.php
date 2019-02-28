<?php

namespace Abdelrahman_badr\CurrencyRate\Core\Contracts;

use Abdelrahman_badr\CurrencyRate\Models\Currency;
use stdClass;

/**
 * Interface CurrencyMapperInterface
 * @package Abdelrahman_badr\CurrencyRate\Core\Contracts
 */
interface CurrencyMapperInterface
{
    /**
     * @param stdClass $currency
     * @return Currency
     */
    public function map(stdClass $currency): Currency;
}