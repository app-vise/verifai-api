<?php

declare(strict_types=1);

namespace Appvise\Verifai\Model;

use DateTime;

final class WebhookRequest
{
    /** @var string $eventType */
    private $eventType;
    /** @var DateTime $created */
    private $created;
    /** @var WebhookData $data */
    private $data;

    public function __construct(string $eventType, DateTime $created, WebhookData $data)
    {
        $this->eventType = $eventType;
        $this->created = $created;
        $this->data = $data;
    }

    public function getEventType(): string
    {
        return $this->eventType;
    }

    public function getCreated(): DateTime
    {
        return $this->created;
    }

    public function getData(): WebhookData
    {
        return $this->data;
    }
}
