<?php


namespace Abdelrahman_badr\CurrencyRate\Services\Factory;

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class WriterXlsxFactory
{
    public function make(Spreadsheet $spreadsheet)
    {
        return new Xlsx($spreadsheet);
    }
}
