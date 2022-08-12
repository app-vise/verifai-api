<?php

declare(strict_types=1);

namespace Appvise\Verifai;

interface SignatureVerifier
{
    public function verify(string $payload, string $signature): bool;
}

