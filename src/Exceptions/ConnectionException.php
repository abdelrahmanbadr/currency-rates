<?php

namespace Abdelrahman_badr\CurrencyRates\Exceptions;

use Abdelrahman_badr\CurrencyRates\Core\Constants\ErrorMessage;
use Exception;

/**
 * Class ConnectionException
 * @package Abdelrahman_badr\CurrencyRates\Exceptions
 */
class ConnectionException extends Exception
{
    /**
     * @return ConnectionException An exception.
     */
    public static function cannotConnectUrl()
    {
        return new self(sprintf(ErrorMessage::API_CONNECTION_ERROR_MESSAGE));
    }


}