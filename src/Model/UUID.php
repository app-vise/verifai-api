<?php

declare(strict_types=1);

namespace Appvise\Verifai\Model;

abstract class UUID
{

    /** @var string $value  */
    private $value;

    protected function __construct(string $value)
    {
        $this->value = $value;
    }

    public function getValue(): string
    {
        return $this->value;
    }
}
