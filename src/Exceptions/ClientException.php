<?php

namespace Abdelrahman_badr\CurrencyRates\Exceptions;

use Abdelrahman_badr\CurrencyRates\Core\Constants\ErrorMessage;

/**
 * Class ClientException
 * @package Abdelrahman_badr\CurrencyRates\Exceptions
 */
class ClientException extends Exception
{
    /**
     * @return ClientException An exception.
     */
    public static function badRequest()
    {
        return new self(sprintf(ErrorMessage::BAD_REQUEST));
    }
}
