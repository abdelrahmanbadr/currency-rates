<?php


namespace Abdelrahman_badr\CurrencyRates\Exceptions;

use Abdelrahman_badr\CurrencyRates\Core\Constants\ErrorMessage;
use Exception;

/**
 * Class ResponseException
 * @package Abdelrahman_badr\CurrencyRates\Exceptions
 */
class ResponseException extends Exception
{
    /**
     * @return ResponseException An exception.
     */
    public static function cannotMapResponse()
    {
        return new self(sprintf(ErrorMessage::API_RESPONSE_NOT_VALID));
    }

}