<?php

declare(strict_types=1);

namespace Appvise\Verifai\Model;

class PointFactory extends AbstractFactory
{
    public static function fromArray(array $data): Point
    {
        return new Point(
            self::pluckInteger('x', $data),
            self::pluckInteger('y', $data)
        );
    }
}
