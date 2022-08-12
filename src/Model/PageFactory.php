<?php

declare(strict_types=1);

namespace Appvise\Verifai\Model;

class PageFactory extends AbstractFactory
{

    /**
     * @param array{image_cropped:string[], image_original:string[], roi:string[], type:string} $data 
     * @return Page 
     */
    public static function fromArray(array $data): Page
    {
        return new Page(
            ImageFactory::fromArray(self::pluckArray('image_cropped', $data)),
            ImageFactory::fromArray(self::pluckArray('image_original', $data)),
            ROIFactory::fromArray(self::pluckArray('roi', $data)),
            self::pluckString('type', $data),
        );
    }
}
