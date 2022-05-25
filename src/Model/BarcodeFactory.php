<?php

declare(strict_types=1);

namespace Appvise\Verifai\Model;

class BarcodeFactory extends AbstractFactory
{
    public static function fromArray(array $data): Barcode
    {
        return new Barcode(
            self::pluckString('type', $data),
            self::pluckString('side', $data),
            self::pluckString('data', $data),
            self::extractPolygon(self::pluckArray('polygon', $data)),
            RectFactory::fromArray(self::pluckArray('rect', $data))
        );
    }

    public static function extractPolygon(array $polygons): array
    {
        $polygons = [];
        foreach ($polygons as $point) {
            $polygons[] = PointFactory::fromArray($point);
        }
        return $polygons;
    }
}
