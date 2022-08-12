<?php

declare(strict_types=1);

namespace Tests\Integration;

use Appvise\Verifai\Model\ProfileUUID;
use Appvise\Verifai\Model\WebhookData;
use Appvise\Verifai\Model\WebhookRequestFactory;
use DateTime;
use Exception;
use PHPUnit\Framework\TestCase;

class WebHookTest extends TestCase
{
    /** @test */
    public function it_process_a_valid_webhook_call(): void
    {
        $fixture = file_get_contents(__DIR__ . '/../__Fixtures__/WebHookData.json');
        if (!$fixture) {
            throw new Exception("Cannot load fixture", 1);
        }
        $payload = json_decode($fixture, true);
        if (!$payload) {
            throw new Exception("Cannot decode fixture", 1);
        }
        $webhookRequest = WebhookRequestFactory::fromArray($payload);
        $this->assertEquals('profile.status', $webhookRequest->getEventType());
        $this->assertInstanceOf(DateTime::class, $webhookRequest->getCreated());
        $this->assertEquals('2022-05-20', $webhookRequest->getCreated()->format('Y-m-d'));
        $data = $webhookRequest->getData();
        $this->assertInstanceOf(WebhookData::class, $data);
        $this->assertInstanceOf(ProfileUUID::class, $data->getProfileUuid());
        $this->assertEquals('a2d6d353-3c14-40d7-b288-5b4fca9e8f09', $data->getProfileUuid()->getValue());
        $this->assertEquals('your reference', $data->getInternalReference());
        $this->assertEquals('completed', $data->getProcessingStatus());
    }
}
