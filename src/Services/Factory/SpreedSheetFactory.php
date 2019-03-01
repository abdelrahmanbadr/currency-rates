<?php

namespace Abdelrahman_badr\CurrencyRate\Services\Factory;

use PhpOffice\PhpSpreadsheet\Spreadsheet;

class SpreedSheetFactory
{
    public function make()
    {
        return new Spreadsheet();
    }
}
