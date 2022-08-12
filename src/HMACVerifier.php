<?php

declare(strict_types=1);

namespace Appvise\Verifai;

class HMACVerifier implements SignatureVerifier
{
    /** @var string $secret */
    private $secret;

    /**
     * Construct the HMAC verifier with the secret you've received from Verifai
     * Use verify function to verify the HMAC(SHA256) signed request from Verifai to ensure
     * the request came from the one and only Verifai service
     * @param string $secret 
     * @return void 
     */
    public function __construct(string $secret)
    {
        $this->secret = $secret;
    }

    public function verify(string $payload, string $signature): bool
    {
        $signatureBytes = hash_hmac("sha256", $payload, $this->secret);
        return $signatureBytes === $signature;
    }
}
