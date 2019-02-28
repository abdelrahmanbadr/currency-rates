<?php


namespace Abdelrahman_badr\CurrencyRate\Services\Excel;

use Abdelrahman_badr\CurrencyRate\Core\Contracts\ExcelSheetAdapterInterface;
use PhpOffice\PhpSpreadsheet\Spreadsheet;

/**
 * Class SpreadsheetAdapter
 * @package Abdelrahman_badr\CurrencyRate\Services\Excel
 */
class SpreadsheetAdapter implements ExcelSheetAdapterInterface
{
    /**
     * @var Spreadsheet
     */
    private $sheet;

    /**
     * PhpSpreadsheetAdapter constructor.
     * @param Spreadsheet|null $sheet
     */
    public function __construct(Spreadsheet $sheet = null)
    {
        isset($sheet) ? ($this->sheet = $sheet) : ($this->sheet = new Spreadsheet());
    }


    /**
     * @return \PhpOffice\PhpSpreadsheet\Worksheet\Worksheet
     * @throws \PhpOffice\PhpSpreadsheet\Exception
     */
    public function getExcelSheet()
    {
        return $this->sheet->getActiveSheet();
    }


}