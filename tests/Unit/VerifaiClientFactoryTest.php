<?php

declare(strict_types=1);

namespace Appvise\Verifai\Test\Unit;

use Appvise\Verifai\VerifaiClient;
use Appvise\Verifai\VerifaiClientFactory;
use PHPUnit\Framework\TestCase;

class VerifaiClientFactoryTest extends TestCase
{
    private const VALID_TOKEN = 'VALID_TOKEN';

    /** @test */
    public function it_should_return_a_new_production_verifai_client(): void
    {
        $client = VerifaiClientFactory::make(self::VALID_TOKEN);
        $this->assertInstanceOf(VerifaiClient::class, $client);
    }

    /** @test */
    public function it_accepts_environment_string(): void
    {
        $client = VerifaiClientFactory::make(self::VALID_TOKEN, 'prod');
        $this->assertInstanceOf(VerifaiClient::class, $client);
    }

    /** @test */
    public function it_accepts_any_enviroment_string_and_returns_production_client(): void
    {
        $client = VerifaiClientFactory::make(self::VALID_TOKEN, 'not_an_environment');
        $this->assertInstanceOf(VerifaiClient::class, $client);
    }
}
