<?php

namespace Abdelrahman_badr\CurrencyRates\Services\Http;

use Exception;
use GuzzleHttp\Client;
use GuzzleHttp\ClientInterface;
use Abdelrahman_badr\CurrencyRates\Core\Contracts\HttpAdapterInterface;
use Abdelrahman_badr\CurrencyRates\Exceptions\ConnectionException;
use Abdelrahman_badr\CurrencyRates\Exceptions\ClientException;
use GuzzleHttp\Exception\ ClientException as GuzzleClientException;
use GuzzleHttp\Exception\RequestException as GuzzleRequestException;

/**
 * Class GuzzleHttpAdapter
 * @package Abdelrahman_badr\CurrencyRates\Services\Http
 */
class GuzzleHttpAdapter implements HttpAdapterInterface
{
    /** @var \GuzzleHttp\ClientInterface */
    private $client;

    /**
     * set guzzle adapter.
     *
     * @param \GuzzleHttp\ClientInterface $client
     * @return void
     */
    public function __construct(ClientInterface $client = null)
    {
        $this->client = $client??new Client();
    }

    public function getContent(string $url, array $headers = []): string
    {
        try {
            $response = $this->client->request("GET", $url, $headers);
            return $response->getBody();
        } catch (GuzzleClientException $e) {
            throw ClientException::badRequest($e);
        } catch (GuzzleRequestException $e) {
            throw  ConnectionException::cannotConnectUrl();
        } catch (Exception $e) {
            throw $e;
        }
    }
}
