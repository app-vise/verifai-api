<?php

declare(strict_types=1);

namespace Appvise\Verifai\Model;

final class Point
{
    private $x;
    private $y;

    public function __construct(?int $x, ?int $y)
    {
        $this->x = $x;
        $this->y = $y;
    }

    public function toArray(): array
    {
        return [
            'x' => $this->x,
            'y' => $this->y,
        ];
    }
}
