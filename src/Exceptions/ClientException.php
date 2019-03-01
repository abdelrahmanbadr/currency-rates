<?php


namespace Abdelrahman_badr\CurrencyRates\Exceptions;

use Exception;

/**
 * Class ClientException
 * @package Abdelrahman_badr\CurrencyRates\Exceptions
 */
class ClientException extends Exception
{
    /**
     * @return ClientException An exception.
     */
    public static function badRequest(Exception $e)
    {
        return new self(sprintf("Bad Request"));
    }

}