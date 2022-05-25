<?php

declare(strict_types=1);

namespace Appvise\Verifai\Model;

final class DataZone
{
    private $title; //str	Title of the data zone
    private $block; //	bool	Whether or not the zone should be blocked
    private $side; //	str	The side of the data zone FRONT or BACK
    private $x; //	float	X coordinate (top-left) relative to the image origin
    private $y; //	float	Y coordinate (top-left) relative to the image origin
    private $height; //	float	Height relative to the image height
    private $width; //float

    public function __construct(
        ?string $title,
        ?bool $block,
        ?string $side,
        ?float $x,
        ?float $y,
        ?float $height,
        ?float $width
    ) {
        $this->title = $title;
        $this->block = $block;
        $this->side = $side;
        $this->x = $x;
        $this->y = $y;
        $this->height = $height;
        $this->width = $width;
    }

    public function toArray(): array
    {
        return [
            'title' => $this->title,
            'block' => $this->block,
            'side' => $this->side,
            'x' => $this->x,
            'y' => $this->y,
            'height' => $this->height,
            'width' => $this->width,
        ];
    }
}
