<?php

namespace Abdelrahman_badr\CurrencyRate\Core\Contracts;
/**
 * Interface WriterInterFace
 * @package Abdelrahman_badr\CurrencyRate\Core\Contracts
 */

interface WriterInterFace
{
    /**
     * @param string $fileName
     * @return mixed
     */
    public function save(string $fileName);
}