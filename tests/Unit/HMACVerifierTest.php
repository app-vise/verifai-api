<?php

declare(strict_types=1);

namespace Appvise\Verifai\Test\Unit;

use Appvise\Verifai\HMACVerifier;
use PHPUnit\Framework\TestCase;

class HMACVerifierTest extends TestCase
{
    private const SECRET = 'SECRET';

    /** @test */
    public function it_validates_a_signed_payload(): void
    {
        $hash = hash_hmac('sha256', 'hello, world!', self::SECRET);
        $verifier = new HMACVerifier(self::SECRET);
        $this->assertTrue($verifier->verify('hello, world!', $hash));
    }

    /** @test */
    public function it_fails_on_a_tampered_request(): void
    {
        $hash = hash_hmac('sha256', 'hello, world!', self::SECRET);
        $verifier = new HMACVerifier(self::SECRET);
        $this->assertFalse($verifier->verify('Tampered request', $hash));
    }

    /** @test */
    public function it_fails_with_wrong_secret(): void
    {
        $hash = hash_hmac('sha256', 'hello, world!', self::SECRET);
        $verifier = new HMACVerifier('INVALID_SECRET');
        $this->assertFalse($verifier->verify('hello, world!', $hash));
    }
}
