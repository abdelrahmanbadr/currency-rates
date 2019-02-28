<?php

namespace Abdelrahman_badr\CurrencyRate\Services\Http;

use Abdelrahman_badr\CurrencyRate\Exceptions\ResponseException;
use GuzzleHttp\Client;
use GuzzleHttp\ClientInterface;
use Abdelrahman_badr\CurrencyRate\Core\Contracts\HttpAdapterInterface;
use Abdelrahman_badr\CurrencyRate\Exceptions\{ConnectionException, ClientException};
use Exception;
use GuzzleHttp\Exception\ ClientException as GuzzleClientException;
use GuzzleHttp\Exception\RequestException as GuzzleRequestException;


/**
 * Class GuzzleHttpAdapter
 * @package Abdelrahman_badr\CurrencyRate\Services\Http
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
        if (isset($client)) {
            $this->client = $client;
        } else {
            $this->client = new Client();
        }
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