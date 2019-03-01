<?php

namespace Abdelrahman_badr\CurrencyRates\Providers;

use Abdelrahman_badr\CurrencyRates\Core\Contracts\CurrencyProviderInterface;

/**
 * Class AbstractProvider
 * @package Abdelrahman_badr\CurrencyRates\Providers
 */
abstract class AbstractProvider implements CurrencyProviderInterface
{
    /**
     * @var string $baseUri
     */
    protected $baseUri;

    /**
     * @param string $path
     * @param array|null $query
     * @return string
     */
    protected function buildUrl(string $path, array $query = null): string
    {
        $url = $this->baseUri . $path;
        if ($query) {
            $url .= '?' . http_build_query($query);
        }
        return urldecode($url);
    }

    /**
     * @param string $base
     * @return string
     */
    protected function sanitizeBase(string $base): string
    {
        //@todo move this to sanitize serve
        return strtoupper($base);

    }

    /**
     * @param array $symbols
     * @return string
     */
    protected function sanitizeSymbols(array $symbols): string
    {
        $upperSymbols = [];
        foreach ($symbols as $symbol) {
            $upperSymbols[] = strtoupper($symbol);
        }
        return implode($upperSymbols, ",");
    }


}