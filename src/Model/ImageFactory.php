<?php

declare(strict_types=1);

namespace Appvise\Verifai\Model;

class ImageFactory extends AbstractFactory
{

    /**
     * @param array{height:int, mime_type:string, url:string, width:int} $data 
     * @return Image 
     */
    public static function fromArray(array $data): Image
    {
        return new Image(
            self::pluckInteger('height', $data),
            self::pluckString('mime_type', $data),
            self::pluckString('url', $data),
            self::pluckInteger('width', $data),
        );
    }
}
