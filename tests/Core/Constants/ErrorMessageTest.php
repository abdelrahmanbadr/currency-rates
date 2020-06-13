<?php

namespace Tests\Core\Constants;

use PHPUnit\Framework\TestCase;
use Abdelrahman_badr\CurrencyRates\Core\Constants\ErrorMessage;

class ErrorMessageTest extends TestCase
{
    public function testConnectionError()
    {
        $this->assertEquals(
            'Request currency exchange rate api failed, please check your connection',
            ErrorMessage::API_CONNECTION_ERROR_MESSAGE
        );
    }

    public function testResponseError()
    {
        $this->assertEquals('Invalid api response', ErrorMessage::API_RESPONSE_NOT_VALID);
    }

    public function testBadRequestError()
    {
        $this->assertEquals('Bad request', ErrorMessage::BAD_REQUEST);
    }
}
