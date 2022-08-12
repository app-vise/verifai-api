<?php

declare(strict_types=1);

namespace Appvise\Verifai\Model;

class ReportFactory extends AbstractFactory
{

    public static function fromArray(array $data): Report
    {
        return new Report(
            self::pluckString('status',$data),
            self::pluckArray('reasons',$data),
        );
    }
}

