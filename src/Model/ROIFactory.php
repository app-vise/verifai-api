<?php

declare(strict_types=1);

namespace Appvise\Verifai\Model;

class ROIFactory extends AbstractFactory
{
    public static function fromArray(array $data): ROI
    {
        return new ROI(
            self::pluckFloat('x1', $data),
            self::pluckFloat('x2', $data),
            self::pluckFloat('x3', $data),
            self::pluckFloat('x4', $data),
            self::pluckFloat('y1', $data),
            self::pluckFloat('y2', $data),
            self::pluckFloat('y3', $data),
            self::pluckFloat('y4', $data),
        );

    }
    
}

