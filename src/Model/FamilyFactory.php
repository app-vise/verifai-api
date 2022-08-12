<?php

declare(strict_types=1);

namespace Appvise\Verifai\Model;

class FamilyFactory extends AbstractFactory
{

    /**
     * @param array{father_name:string, maiden_name:string, marital_status:string, mother_name:string, spouse_name:string} $data 
     * @return Family 
     */
    public static function fromArray(array $data): Family
    {
        return new Family(
            self::pluckString('father_name', $data),
            self::pluckString('maiden_name', $data),
            self::pluckString('marital_status', $data),
            self::pluckString('mother_name', $data),
            self::pluckString('spouse_name', $data),
        );
    }
    
}

