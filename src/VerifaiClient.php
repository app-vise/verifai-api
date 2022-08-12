<?php

declare(strict_types=1);

namespace Appvise\Verifai;

use Appvise\Verifai\Http\Body;
use Appvise\Verifai\Http\ClientInterface;
use Appvise\Verifai\Http\VerifaiResponse;
use Appvise\Verifai\Model\OneTimePassword;
use Appvise\Verifai\Model\UUID;
use Appvise\Verifai\Model\VerifaiResultFactory;
use Appvise\Verifai\VerifaiClientInterface;
use Psr\Http\Message\ResponseInterface;
use RuntimeException;

class VerifaiClient implements VerifaiClientInterface
{
    /** @var ClientInterface $httpClient */
    private $httpClient;

    private const API = 'https://api.verifai.com/v1/';
    private const OTP_URL = 'https://websdk.verifai.com/v1/';

    public function __construct(ClientInterface $httpClient)
    {
        $this->httpClient = $httpClient;
    }

    public function obtainOTP(Body $body): OneTimePassword
    {
        /** @var ResponseInterface $response */
        $response = $this->httpClient->post(self::OTP_URL . 'auth/token', $body->toArray());
        $responseBody = $this->extractContents($response);
        return new OneTimePassword($responseBody['token'], $responseBody['expire'], (bool)$responseBody['used']);
    }

    public function getVerifaiResult(UUID $profileUUID): VerifaiResponse
    {
        /** @var ResponseInterface $response */
        $response =  $this->httpClient->get(self::API . "profile/{$profileUUID->getValue()}/result");
        $body =  $this->extractContents($response);
        $verifaiResult = VerifaiResultFactory::fromArray($body);
        return new VerifaiResponse($response->getStatusCode(), $verifaiResult);
    }

    /**
     * @param ResponseInterface $response 
     * @return string[]
     * @throws RuntimeException 
     */
    private function extractContents(ResponseInterface $response): array
    {
        return json_decode($response->getBody()->getContents(), true);
    }
}
