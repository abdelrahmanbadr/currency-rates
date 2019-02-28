<?php

namespace Abdelrahman_badr\CurrencyRates\Core\Contracts;
/**
 * Interface WriterInterFace
 * @package Abdelrahman_badr\CurrencyRates\Core\Contracts
 */

interface WriterInterFace
{
    /**
     * @param string $fileName
     * @return mixed
     */
    public function save(string $fileName);
}