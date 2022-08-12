<?php

declare(strict_types=1);

namespace Appvise\Verifai\Model;

class DataFactory extends AbstractFactory
{

    /**
     * @param array{country:string, date_of_expiry:string, date_of_issue:string, document_number:string, issuing_authority:string, mrz_lines:string[], place_of_issue:string} $data 
     * @return Data 
     */
    public static function fromArray(array $data): Data
    {
        return new Data(
            self::pluckString('country', $data),
            self::pluckDate('date_of_expiry', $data, 'Y-m-d'),
            self::pluckDate('date_of_issue', $data, 'Y-m-d'),
            self::pluckString('document_number', $data),
            self::pluckString('issuing_authority', $data),
            self::pluckArray('mrz_lines', $data),
            self::pluckString('place_of_issue', $data),
        );
    }

}

