<?php

declare(strict_types=1);

namespace Appvise\Verifai\Model;

final class IDModel
{
    private $country; //	str	Two letter country code
    private $hasMrz; //	bool	Document type has a MRZ
    private $widthMm; //	int	Width of the Document in mm
    private $heightMm; //	int	Height of the Document in mm
    private $model; //	str	Document model name
    private $type; //	str	Document type
    private $sampleFront; //	str	base-64 encoded image of the front
    private $uuid; //	str	Document uuid in Verifai backend
    private $zones = []; //	array	Array with Data Zone objects

    public function __construct(
        ?string $country,
        ?bool $hasMrz,
        ?int $widthMm,
        ?int $heightMm,
        ?string $model,
        ?string $type,
        ?string $sampleFront,
        ?string $uuid,
        ?array $zones
    ) {
        $this->country = $country;
        $this->hasMrz = $hasMrz;
        $this->widthMm = $widthMm;
        $this->heightMm = $heightMm;
        $this->model = $model;
        $this->type = $type;
        $this->sampleFront = $sampleFront;
        $this->uuid = $uuid;
        $this->zones = $zones;
    }


    public function toArray(): array
    {
        $zones = [];
        foreach ($this->zones as $zone) {
            $zones .= $zone->toArray();
        }
        return [
            'country' => $this->country,
            'hasMrz' => $this->hasMrz,
            'widthMm' => $this->widthMm,
            'heightMm' => $this->heightMm,
            'model' => $this->model,
            'type' => $this->type,
            'sampleFront' => $this->sampleFront,
            'uuid' => $this->uuid,
            'zones' => $zones
        ];
    }
}
