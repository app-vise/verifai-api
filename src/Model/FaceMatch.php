<?php

declare(strict_types=1);

namespace Appvise\Verifai\Model;

final class FaceMatch
{
    private $confidence; // 0.98537 float,
    private $matches; // true bool

    public function __construct(?float $confidence, ?bool $matches)
    {
        $this->confidence = $confidence;
        $this->matches = $matches;
    }

    public function toArray(): array
    {
        return [
            'confidence' => $this->confidence,
            'matches' => $this->matches
        ];
    }
}
