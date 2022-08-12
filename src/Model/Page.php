<?php

declare(strict_types=1);

namespace Appvise\Verifai\Model;

class Page
{
    /** @var Image $imageCropped */
    private $imageCropped;
    /** @var Image $imageOriginal */
    private $imageOriginal;
    /** @var ROI $roi */
    private $roi;
    /** @var string $type */
    private $type;

    public function __construct(Image $imageCropped, Image $imageOriginal, ROI $roi, string $type) {
        $this->imageCropped = $imageCropped;
        $this->imageOriginal = $imageOriginal;
        $this->roi = $roi;
        $this->type = $type;
    }

    public function getImageCropped(): Image
    {
        return $this->imageCropped;
    }

    public function getImageOriginal(): Image
    {
        return $this->imageOriginal;
    }

    public function getRoi(): ROI
    {
        return $this->roi;
    }

    public function getType(): string
    {
        return $this->type;
    }
}

