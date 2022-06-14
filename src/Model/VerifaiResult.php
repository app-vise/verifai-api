<?php

declare(strict_types=1);

namespace Appvise\Verifai\Model;

class VerifaiResult
{
    /** @var string $backImage */
    private $backImage;
    /** @var string $frontImage */
    private $frontImage;
    /** @var string $frontImageOriginal */
    private $frontImageOriginal;
    /** @var string $backImageOriginal */
    private $backImageOriginal;
    /** @var string $faceImage */
    private $faceImage;
    /** @var IDModel $idModel */
    private $idModel;
    /** @var MRZ $mrzData */
    private $mrzData;
    /** @var Barcode[] $barcodes */
    private $barcodes = [];
    /** @var VIZ $vizData */
    private $vizData;
    /** @var FaceMatch $faceMatchData */
    private $faceMatchData;

    public function __construct(
        ?string $backImage,
        ?string $frontImage,
        ?string $faceImage,
        ?string $frontImageOriginal,
        ?string $backImageOriginal,
        IDModel $idModel,
        MRZ $mrzData,
        array $barcodes,
        VIZ $vizData,
        FaceMatch $faceMatchData
    ) {
        $this->backImage = $backImage;
        $this->frontImage = $frontImage;
        $this->frontImageOriginal = $frontImageOriginal;
        $this->backImageOriginal = $backImageOriginal;
        $this->faceImage = $faceImage;
        $this->idModel = $idModel;
        $this->mrzData = $mrzData;
        $this->barcodes = $barcodes;
        $this->vizData = $vizData;
        $this->faceMatchData = $faceMatchData;
    }

    public function getBackImage(): ?string
    {
        return $this->backImage;
    }

    public function getFrontImage(): ?string
    {
        return $this->frontImage;
    }

    public function getFrontImageOriginal(): ?string
    {
        return $this->frontImageOriginal;
    }

    public function getBackImageOriginal(): ?string
    {
        return $this->backImageOriginal;
    }

    public function getFaceImage(): ?string
    {
        return $this->faceImage;
    }

    public function getIdModel(): ?IDModel
    {
        return $this->idModel;
    }

    public function getMrzData(): ?MRZ
    {
        return $this->mrzData;
    }

    public function getBarcodes(): array
    {
        return $this->barcodes;
    }

    public function getVizData(): ?VIZ
    {
        return $this->vizData;
    }

    public function getFaceMatchData(): ?FaceMatch
    {
        return $this->faceMatchData;
    }

    public function toArray(): array
    {
        $barcodes = [];
        foreach( $this->barcodes as $key => $barcode) {
            array_push($barcodes, $barcode->toArray());
        }
        return [
            'faceImage' => $this->faceImage,
            'frontImage' => $this->frontImage,
            'backImage' => $this->backImage,
            'frontImageOriginal' => $this->frontImageOriginal,
            'backImageOriginal' => $this->backImageOriginal,
            'idModel' => $this->idModel->toArray(),
            'faceMatchData' => $this->faceMatchData->toArray(),
            'vizData' => $this->vizData->toArray(),
            'mrzData' => $this->mrzData->toArray(),
            'barcodes' => $barcodes,
        ];
    }

}
