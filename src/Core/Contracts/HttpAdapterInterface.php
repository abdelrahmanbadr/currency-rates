<?php

namespace Abdelrahman_badr\CurrencyRates\Core\Contracts;


/**
 * Interface HttpAdapterInterface
 * @package Abdelrahman_badr\CurrencyRates\Core\Contracts
 */
interface HttpAdapterInterface
{

    /**
     * @param string $url
     * @param array $headers
     * @return string
     */
    public function getContent(string $url, array $headers = []): string;

}