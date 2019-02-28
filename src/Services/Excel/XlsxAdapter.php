<?php


namespace Abdelrahman_badr\CurrencyRate\Services\Excel;


use Abdelrahman_badr\CurrencyRate\Core\Contracts\WriterInterFace;
use Abdelrahman_badr\CurrencyRate\Core\Contracts\ExcelSheetAdapterInterface;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

/**
 * Class XlsxAdapter
 * @package Abdelrahman_badr\CurrencyRate\Services\Excel
 */
class XlsxAdapter implements WriterInterFace
{
    /**
     * @var Xlsx
     */
    private $xlx;

    /**
     * XlsxAdapter constructor.
     * @param Xlsx|null $xlx
     * @param ExcelSheetAdapterInterface $excelSheet
     */
    public function __construct(ExcelSheetAdapterInterface $excelSheet, Xlsx $xlx = null)
    {
        isset($xlx) ? ($this->xlx = $xlx) : ($this->xlx = new Xlsx($excelSheet));
    }

    public function save(string $filename)
    {
        $this->xlx->save($filename);
    }

}