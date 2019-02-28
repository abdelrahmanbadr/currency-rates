<?php

namespace Abdelrahman_badr\CurrencyRate\Exceptions;

use Abdelrahman_badr\CurrencyRate\Core\Constants\ErrorMessage;
use Exception;

/**
 * Class ConnectionException
 * @package Abdelrahman_badr\CurrencyRate\Exceptions
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