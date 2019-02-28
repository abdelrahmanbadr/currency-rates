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
        dd($e->getMessage());
        //@todo parse error message
        return new self(sprintf("Bad Request"));
    }

}