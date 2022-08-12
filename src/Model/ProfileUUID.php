<?php

declare(strict_types=1);

namespace Appvise\Verifai\Model;

class ProfileUUID extends UUID
{
    public static function make(string $value): self
    {
        return new self($value);
    }
}

