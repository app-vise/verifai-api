<?php

declare(strict_types=1);

namespace Appvise\Verifai\Model;

class VerifaiResultFactory extends AbstractFactory
{
    public static function fromArray(array $data): VerifaiResult
    {
        return new VerifaiResult(
            self::pluckString('backImage', $data),
            self::pluckString('frontImage', $data),
            self::pluckString('faceImage', $data),
            self::pluckString('frontImageOriginal', $data),
            self::pluckString('backImageOriginal', $data),
            IDModelFactory::fromArray(self::pluckArray('idModel', $data)),
            MRZFactory::fromArray(self::pluckArray('mrzData', $data)),
            self::extractBarcodes(self::pluckArray('barcodes', $data)),
            VIZFactory::fromArray(self::pluckArray('vizData', $data)),
            FaceMatchFactory::fromArray(self::pluckArray('faceMatchData', $data))
        );
    }

    public static function extractBarcodes(array $barcodesData): array
    {
        $barcodes = [];
        foreach ($barcodesData as $barcode) {
            $barcodes[] = BarcodeFactory::fromArray($barcode);
        }
        return $barcodes;
    }
}
