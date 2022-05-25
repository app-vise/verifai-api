<?php

declare(strict_types=1);

namespace Appvise\Verifai\Model;

final class Rect
{
    private $left; //	int	Left coordinate of the barcode in the image
    private $top; //	int	Top coordinate of the barcode in the image
    private $width; //	int	Width of the barcode in the image
    private $height; //	int	Height of the barcode in the image
    //
    public function __construct(?int $left, ?int $top, ?int $width, ?int $height)
    {
        $this->left = $left;
        $this->top = $top;
        $this->width = $width;
        $this->height = $height;
    }

    public function toArray(): array
    {
        return [
            'left' => $this->left,
            'right' => $this->right,
            'width' => $this->width,
            'height' => $this->height,
        ];
    }
}
