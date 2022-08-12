<?php

declare(strict_types=1);

namespace Appvise\Verifai\Model;

use Appvise\Verifai\Model\AbstractFactory;

class WebhookDataFactory extends AbstractFactory
{
    /**
     * @param array{string[], processing_status:string, internal_reference:string} $data 
     * @return WebhookData 
     */
    public static function fromArray(array $data): WebhookData
    {
        return new WebhookData(
            UUIDFactory::createUUID('profile_uuid', $data),
            self::pluckString('processing_status', $data),
            self::pluckString('internal_reference', $data),
        );
    }
}
