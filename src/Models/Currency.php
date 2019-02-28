<?php

namespace Abdelrahman_badr\CurrencyRate\Models;

use DateTime, stdClass;

/**
 * Class Currency
 * @package Abdelrahman_badr\CurrencyRate\Models
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