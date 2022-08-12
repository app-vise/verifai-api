<?php

declare(strict_types=1);

namespace Appvise\Verifai\Model;

class Image
{
    /** @var int $height */
    private $height;
    /** @var string $mimeType */
    private $mimeType;
    /** @var string $url */
    private $url;
    /** @var int $width */
    private $width;

    public function __construct(int $height, string $mimeType, string $url, int $width)
    {
        $this->height = $height;
        $this->mimeType = $mimeType;
        $this->url = $url;
        $this->width = $width;
    }

    public function getHeight(): int
    {
        return $this->height;
    }

    public function getMimeType(): string
    {
        return $this->mimeType;
    }

    public function getUrl(): string
    {
        return $this->url;
    }

    public function getWidth(): int
    {
        return $this->width;
    }
}
