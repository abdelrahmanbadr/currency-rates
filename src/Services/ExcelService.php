<?php

namespace Abdelrahman_badr\currencyRate\Services;

use Abdelrahman_badr\CurrencyRate\Services\Factory\WriterXlsxFactory;
use Abdelrahman_badr\CurrencyRate\Services\Factory\SpreedSheetFactory;

class ExcelService
{
    public $spreadsheet;

    public function __construct()
    {
        $this->spreadsheet = (new SpreedSheetFactory())->make();
    }

    public function getActiveSheet()
    {
        return $this->spreadsheet->getActiveSheet();
    }

    public function saveExcelSheet($fileName)
    {
        $writer = (new WriterXlsxFactory())->make($this->spreadsheet);
        $writer->save($fileName . ".xlsx");
    }
}
