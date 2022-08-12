<?php

declare(strict_types=1);

namespace Appvise\Verifai;

use Appvise\Verifai\Http\Adapter\Guzzle\GuzzleClient;
use GuzzleHttp\Client;

class VerifaiClientFactory
{
    public static function make(string $token, string $environment = 'production'): VerifaiClientInterface
    {
        switch ($environment) {
            case 'production':
            case 'prod':
            default:
                $guzzle = new Client([
                    "headers" => [
                        "Authorization" => "Bearer {$token}"
                    ]
                ]);
                $httpClient = new GuzzleClient($guzzle);
                return new VerifaiClient($httpClient);
        }
    }
}
