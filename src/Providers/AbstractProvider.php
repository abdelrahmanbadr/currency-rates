<?php

namespace Abdelrahman_badr\CurrencyRate\Providers;

use Abdelrahman_badr\CurrencyRate\Core\Contracts\CurrencyProviderInterface;

/**
 * Class AbstractProvider
 * @package Abdelrahman_badr\CurrencyRate\Providers
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


}