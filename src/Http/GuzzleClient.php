<?php

declare(strict_types=1);

namespace Appvise\Verifai\Http;

use GuzzleHttp\Client;
use Psr\Http\Message\ResponseInterface;
use GuzzleHttp\Exception\RequestException;

/** @package Appvise\Verifai\Http */
class GuzzleClient implements ClientInterface
{

    /** @var Client $client */
    private $client;

    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    public function post(string $url, $body): ResponseInterface
    {
        return $this->hit('POST', $url, $body);
    }

    public function get(string $url): ResponseInterface
    {
        return $this->hit('GET', $url);
    }

    public function delete(string $url): ResponseInterface
    {
        return $this->hit('DELETE', $url);
    }

    private function hit(string $method = 'GET', string $url, ?array $options = [])
    {
        try {
            return $this->client->request($method, $url, ['json' => $options]);
        } catch (RequestException $exception) {
            ExceptionHandler::handle($exception);
        }
    }
}
