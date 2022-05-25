<?php

declare(strict_types=1);

namespace Appvise\Verifai;

use Appvise\Verifai\Http\Body;
use Appvise\Verifai\Http\ClientInterface;
use Appvise\Verifai\Http\SessionId;
use Appvise\Verifai\Http\VerifaiResponse;
use Appvise\Verifai\Model\OneTimePassword;
use Appvise\Verifai\Model\VerifaiResultFactory;
use Appvise\Verifai\VerifaiClientInterface;
use GuzzleHttp\Psr7\Response;

class VerifaiClient implements VerifaiClientInterface
{
    /** @var ClientInterface $httpClient */
    private $httpClient;

    private const URL = 'https://websdk.verifai.com/v1/';

    public function __construct(ClientInterface $httpClient)
    {
        $this->httpClient = $httpClient;
    }

    public function obtainOTP(Body $body)
    {
        /** @var Response $response */
        $response = $this->httpClient->post(self::URL .'auth/token', $body->toArray());
        $responseBody = $this->extractContents($response);
        return new OneTimePassword($responseBody['token'], $responseBody['expire'], $responseBody['used']);
    }

    public function deleteSession(SessionId $sessionId)
    {
        $url = self::URL . "session/{$sessionId->value()}";
        $response = $this->httpClient->delete($url);
        return new VerifaiResponse($response->getStatusCode(), null);
    }

    public function getVerifaiResult(SessionId $sessionId)
    {
        $url = self::URL . "session/{$sessionId->value()}/verifai-result";
        $response =  $this->httpClient->get($url);
        $body =  $this->extractContents($response);
        $verifaiResult = VerifaiResultFactory::fromArray($body);
        return new VerifaiResponse($response->getStatusCode(), $verifaiResult);
    }

    private function extractContents($response): array
    {
        return json_decode($response->getBody()->getContents(), true);
    }
}
