<?php

declare(strict_types=1);

namespace Appvise\Verifai\Http\Adapter\Guzzle;

use Appvise\Verifai\Http\ClientInterface;
use Appvise\Verifai\Http\ExceptionHandler;
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

    public function post(string $url, ?array $body = []): ResponseInterface
    {
        return $this->hit($url, 'POST', $body);
    }

    public function get(string $url): ResponseInterface
    {
        return $this->hit($url, 'GET');
    }

    private function hit(string $url, string $method = 'GET', ?array $options = [])
    {
        try {
            return $this->client->request($method, $url, ['json' => $options]);
        } catch (RequestException $exception) {
            ExceptionHandler::handle($exception);
        }
    }
}
