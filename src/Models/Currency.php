<?php

namespace Abdelrahman_badr\CurrencyRates\Models;

use DateTime, stdClass;

/**
 * Class Currency
 * @package Abdelrahman_badr\CurrencyRates\Models
 */
class Currency
{
    /**
     * @var stdClass
     */
    public $rates;
    /**
     * @var string
     */
    public $base;
    /**
     * @var DateTime
     */
    public $date;
    /**
     * @var DateTime
     */
    public $startAt;
    /**
     * @var DateTime
     */
    public $endAt;

}