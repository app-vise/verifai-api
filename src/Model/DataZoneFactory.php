<?php

declare(strict_types=1);

namespace Appvise\Verifai\Model;

class DataZoneFactory extends AbstractFactory
{
    public static function fromArray(array $data): DataZone
    {
        return new DataZone(
            self::pluckString('title', $data),
            self::pluckBoolean('block', $data),
            self::pluckString('side', $data),
            self::pluckFloat('x', $data),
            self::pluckFloat('x', $data),
            self::pluckFloat('height', $data),
            self::pluckFloat('width', $data),
        );
        
    }
    //
}
