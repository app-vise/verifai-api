<?php

declare(strict_types=1);

namespace Appvise\Verifai;

use Appvise\Verifai\Http\GuzzleClient;
use GuzzleHttp\Client;

class VerifaiClientFactory
{
    public static function make(string $token, $environment = 'production')
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
