<?php

declare(strict_types=1);

namespace Appvise\Verifai\Model;

class RectFactory extends AbstractFactory
{
    public static function fromArray(array $data): Rect
    {
        return new Rect(
            self::pluckInteger('left', $data),
            self::pluckInteger('top', $data),
            self::pluckInteger('width', $data),
            self::pluckInteger('height', $data),
        );
    }
}
