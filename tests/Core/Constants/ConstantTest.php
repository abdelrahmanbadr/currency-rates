<?php

namespace Tests\Core\Constants;

use PHPUnit\Framework\TestCase;
use Abdelrahman_badr\CurrencyRates\Core\Constants\Constant;

class ConstantTest extends TestCase
{
    public function testBaseCurrency()
    {
        $this->assertEquals('EUR', Constant::BASE_CURRENCY);
    }

    public function testDateFormat()
    {
        $this->assertEquals('Y-m-d', Constant::DATE_FORMAT);
    }

    public function testExcelSheetTitle()
    {
        $this->assertEquals('Currency Exchange Rates Of ', Constant::EXCEL_SHEET_TITLE);
    }
}
