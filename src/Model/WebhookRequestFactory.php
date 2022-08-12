<?php

declare(strict_types=1);

namespace Appvise\Verifai\Model;

use Appvise\Verifai\Model\AbstractFactory;

final class WebhookRequestFactory extends AbstractFactory
{

    /**
     * @param array{event_type:string[], created:string, data:string[]} $data
     * @return WebhookRequest 
     */
    public static function fromArray(array $data): WebhookRequest
    {
        return new WebhookRequest(
            self::pluckString('event_type', $data),
            self::pluckDate('created', $data, 'Y-m-d\TH:i:s\.u'),
            WebhookDataFactory::fromArray(self::pluckArray('data', $data))
        );
    }
}
