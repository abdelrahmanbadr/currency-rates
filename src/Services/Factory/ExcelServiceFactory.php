<?php

namespace Abdelrahman_badr\CurrencyRates\Services\Factory;

use Abdelrahman_badr\currencyRate\Services\ExcelService;

class ExcelServiceFactory
{
    public function make()
    {
        return new ExcelService();
    }
}
