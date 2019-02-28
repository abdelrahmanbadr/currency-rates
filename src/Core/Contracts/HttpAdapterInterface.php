<?php

namespace Abdelrahman_badr\CurrencyRate\Core\Contracts;


/**
 * Interface HttpAdapterInterface
 * @package Abdelrahman_badr\CurrencyRate\Core\Contracts
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