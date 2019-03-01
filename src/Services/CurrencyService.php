<?php

namespace Abdelrahman_badr\CurrencyRates\Services;

use Abdelrahman_badr\currencyRate\Services\ExcelService;
use Abdelrahman_badr\CurrencyRates\Core\Constants\Constant;
use Abdelrahman_badr\CurrencyRates\Core\Contracts\{CurrencyMapperInterface,
    HttpAdapterInterface,
    CurrencyServiceInterface,
    CurrencyProviderInterface};
use Abdelrahman_badr\CurrencyRates\Services\Http\GuzzleHttpAdapter;
use Abdelrahman_badr\CurrencyRates\Models\Currency;
use stdClass, DateTime, Cache;

/**
 * Class CurrencyService
 * @package Abdelrahman_badr\CurrencyRates\Services
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
     * @var ExcelService
     */
    private $excelService;


    /**
     * @param CurrencyProviderInterface $provider
     * @param CurrencyMapperInterface $mapper
     * @param HttpAdapterInterface $request
     * @param ExcelService $excelService
     * @return void
     */
    public function __construct(CurrencyProviderInterface $provider, CurrencyMapperInterface $mapper, HttpAdapterInterface $request, ExcelService $excelService)
    {
        $this->mapper = $mapper;
        $this->provider = $provider;
        $this->apiRequest = $request;
        $this->excelService = $excelService;
    }

    /**
     * @param string $endPoint
     * @return stdClass
     * @throws \CurrencyRates\Exceptions\ClientException
     * @throws \CurrencyRates\Exceptions\ConnectionException
     */
    private function getProviderResponse(string $endPoint): stdClass
    {
        return json_decode($this->apiRequest->getContent($endPoint));
    }

    //@todo use transformer
    public function getLatest(string $base = Constant::BASE_CURRENCY, array $symbols = []): Currency
    {
        $endPoint = $this->provider->getLatestUrl($base, $symbols);
        $result = $this->getCurrencyRatesIfCacheEnabled($endPoint);
        if (empty($result)) {
            $result = $this->getProviderResponse($endPoint);
        }
        return $this->mapper->map($result);
    }

    public function getHistorical(DateTime $startAt, DateTime $endAt = null, string $base = Constant::BASE_CURRENCY, array $symbols = []): Currency
    {
        $endPoint = $this->provider->getHistoricalUrl($base, $startAt, $endAt, $symbols);
        $result = $this->getCurrencyRatesIfCacheEnabled($endPoint);
        if (empty($result)) {
            $result = $this->getProviderResponse($endPoint);
        }
        return $this->mapper->map($result);
    }

    public function exportHistorical(string $fileName, DateTime $startAt, DateTime $endAt = null, string $base = Constant::BASE_CURRENCY, array $symbols = [])
    {
        $currency = $this->getHistorical($startAt, $endAt, $base, $symbols);
        $sheet = $this->excelService->getActiveSheet();
        $sheet->setTitle(Constant::EXCEL_SHEET_TITLE . $base);
        $this->fillSheetByHistoricalRates($sheet, $currency->rates);
        $this->excelService->saveExcelSheet($fileName);
    }


    public function exportLatest(string $fileName, string $base = Constant::BASE_CURRENCY, array $symbols = [])
    {
        $currency = $this->getLatest($base, $symbols);
        $sheet = $this->excelService->getActiveSheet();
        $sheet->setTitle(Constant::EXCEL_SHEET_TITLE . $base);
        $this->fillSheetByLatestRates($sheet, $currency->rates);
        $this->excelService->saveExcelSheet($fileName);
    }

    private function getCurrencyRatesIfCacheEnabled(string $endPoint)
    {
        $result = null;
        if (env('CURRENCY_RATES_CACHE_IS_ENABLED')) {
            $md5 = md5($endPoint);
            if (Cache::Has($md5)) {
                $result = Cache::get($md5);
            } else {
                $result = $this->getProviderResponse($endPoint);
                Cache::put($md5, $result, env("CURRENCY_RATES_CACHE_EXPIRY"));
            }
        }
        return $result;
    }

    private function fillSheetByHistoricalRates(&$sheet, $rates)
    {
        $counter = 1;
        foreach ($rates as $date => $exchangeRates) {

            $sheet->setCellValue('A' . $counter, $date);
            $counter++;
            foreach ($exchangeRates as $currency => $rate) {
                $sheet->setCellValue('A' . $counter, $currency);
                $sheet->setCellValue('B' . $counter, $rate);
                $counter++;
            }
        }

    }

    private function fillSheetByLatestRates(&$sheet, $rates)
    {
        $counter = 1;

        foreach ($rates as $currency => $rate) {
            $sheet->setCellValue('A' . $counter, $currency);
            $sheet->setCellValue('B' . $counter, $rate);
            $counter++;
        }
    }

}