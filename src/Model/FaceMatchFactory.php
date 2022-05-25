<?php

declare(strict_types=1);

namespace Appvise\Verifai\Model;

class FaceMatchFactory extends AbstractFactory
{
    public static function fromArray(array $data): FaceMatch
    {
        return new FaceMatch(
            self::pluckFloat('confidence', $data),
            self::pluckBoolean('matches', $data)
        );
    }
}
