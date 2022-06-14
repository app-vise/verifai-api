<?php

declare(strict_types=1);

namespace Appvise\Verifai\Model;

final class Barcode
{
    private $type;
    private $side;
    private $data;
    private $polygon = [];
    private $rect;

    public function __construct(string $type, string $side, string $data, array $polygon, Rect $rect)
    {
        $this->type = $type;
        $this->side = $side;
        $this->data = $data;
        $this->polygon = $polygon;
        $this->rect = $rect;
    }

    public function toArray(): array
    {
        $points = [];
        foreach ($this->polygon as $key => $polygon) {
            array_push($points, $polygon->toArray());
        }

        return [
            'type' => $this->type,
            'side' => $this->side,
            'data' => $this->data,
            'polygon' => $points,
            'rect' => $this->rect,
        ];
    }
}
