<?php

namespace Abdelrahman_badr\CurrencyRate\Services;

use Abdelrahman_badr\CurrencyRate\Core\Constants\Constant;
use Abdelrahman_badr\CurrencyRate\Core\Contracts\{CurrencyMapperInterface,
    HttpAdapterInterface,
    CurrencyServiceInterface,
    ExcelSheetAdapterInterface,
    WriterInterFace,
    CurrencyProviderInterface};
use Abdelrahman_badr\CurrencyRate\Services\Http\GuzzleHttpAdapter;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use Abdelrahman_badr\CurrencyRate\Models\Currency;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use stdClass, DateTime;


/**
 * Class CurrencyService
 * @package Abdelrahman_badr\CurrencyRate\Services
 */
class CurrencyService implements CurrencyServiceInterface
{

    /**
     * @var CurrencyMapperInterface
     */
    private $mapper;
    /**
     * @var CurrencyProviderInterface
     */
    private $provider;

    /**
     * @var GuzzleHttpAdapter
     */
    private $apiRequest;

    /**
     * @var ExcelSheetAdapterInterface
     */
    private $excelSheet;
    /**
     * @var WriterInterFace
     */
    private $writer;

    /**
     * @param CurrencyProviderInterface $provider
     * @param CurrencyMapperInterface $mapper
     * @param HttpAdapterInterface $request
     * @return void
     */
    public function __construct(CurrencyProviderInterface $provider, CurrencyMapperInterface $mapper, HttpAdapterInterface $request)
    {
        $this->mapper = $mapper;
        $this->provider = $provider;
        $this->apiRequest = $request;
    }

    public function setExcelSheet(Spreadsheet $excelSheet)
    {
        $this->excelSheet = $excelSheet;
    }

    /**
     * @param string $endPoint
     * @return stdClass
     * @throws \CurrencyRate\Exceptions\ClientException
     * @throws \CurrencyRate\Exceptions\ConnectionException
     */
    private function getProviderResponse(string $endPoint): stdClass
    {
        return json_decode($this->apiRequest->getContent($endPoint));
    }


    //@todo implement caching in the user side
    public function getLatest(string $base = Constant::BASE_CURRENCY, array $symbols = []): Currency
    {
        $endPoint = $this->provider->getLatestUrl($base, $symbols);
        $result = $this->getProviderResponse($endPoint);
        $mappedObject = $this->mapper->map($result);
        //@todo inject transformer in this service and use it here
        return $mappedObject;
    }

    public function getHistorical(DateTime $startAt, DateTime $endAt = null, string $base = Constant::BASE_CURRENCY, array $symbols = []): Currency
    {
        $endPoint = $this->provider->getHistoricalUrl($base, $startAt, $endAt, $symbols);
        $result = $this->getProviderResponse($endPoint);
        $mappedObject = $this->mapper->map($result);
        //@todo inject transformer in this service and use it here
        return $mappedObject;

    }

    public function exportHistorical(string $fileName, DateTime $startAt, DateTime $endAt = null, string $base = Constant::BASE_CURRENCY, array $symbols = [])
    {
        $currency = $this->getHistorical($startAt, $endAt, $base, $symbols);
        $sheet = $this->excelSheet->getExcelSheet();
        $sheet->setTitle(Constant::EXCEL_SHEET_TITLE);
        $counter = 0;
        foreach ($currency->rates as $date => $exchangeRates) {
            $sheet->setCellValue('A' . $counter, $date);
            $counter++;
            foreach ($exchangeRates as $currency => $rate) {
                $sheet->setCellValue('A' . $counter, $currency);
                $sheet->setCellValue('B' . $counter, $rate);
                $counter++;
            }
        }
        $this->writer->save($fileName);
    }

    public function exportLatest(string $fileName, string $base = Constant::BASE_CURRENCY, array $symbols = [])
    {
        $currency = $this->getLatest($base, $symbols);
        $sheet = $this->excelSheet->getActiveSheet();
        $sheet->setTitle(Constant::EXCEL_SHEET_TITLE);
        $counter = 0;

        foreach ($currency->rates as $currency => $rate) {

            $sheet->setCellValue('A' . $counter, $currency);
            $sheet->setCellValue('B' . $counter, $rate);
            $counter++;
        }

        $writer = new Xlsx($this->excelSheet);
        $writer->save($fileName);
    }

}