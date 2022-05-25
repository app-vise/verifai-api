<?php

declare(strict_types=1);

namespace Appvise\Verifai\Model;

class IDModelFactory extends AbstractFactory
{
    public static function fromArray(array $data): IDModel
    {
        return new IDModel(
            self::pluckString('country', $data),
            self::pluckBoolean('has_mrz', $data),
            self::pluckInteger('width_mm', $data),
            self::pluckInteger('height_mm', $data),
            self::pluckString('model', $data),
            self::pluckString('type', $data),
            self::pluckString('sample_front', $data),
            self::pluckString('uuid', $data),
            self::extractZones(self::pluckArray('zones', $data))
        );
    }

    private static function extractZones(array $zonesData)
    {
        $zones = [];
        foreach ($zonesData as $zone) {
            $zones[] = DataZoneFactory::fromArray($zone);
        }
        return $zones;
    }
}
