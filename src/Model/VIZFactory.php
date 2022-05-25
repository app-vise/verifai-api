<?php

declare(strict_types=1);

namespace Appvise\Verifai\Model;

class VIZFactory extends AbstractFactory
{
    public static function fromArray(array $data): VIZ
    {
        return new VIZ(
            self::pluckString('date_of_birth', $data),
            self::pluckString('date_of_expiry', $data),
            self::pluckString('date_of_issue', $data),
            self::pluckString('document_number', $data),
            self::pluckString('issuing_auth', $data),
            self::pluckString('place_of_birth', $data),
            self::pluckString('sex', $data)
        );
    }
}
