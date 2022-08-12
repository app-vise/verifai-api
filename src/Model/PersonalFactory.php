<?php

declare(strict_types=1);

namespace Appvise\Verifai\Model;

class PersonalFactory extends AbstractFactory
{
    /**
     * @param array{date_of_birth:string, given_names:string, height:int, last_name:string, nationality:string, personal_identity_number:string, place_of_birth:string, sex:string} $data 
     * @return Personal 
     */
    public static function fromArray(array $data): Personal
    {
        return new Personal(
            self::pluckDate('date_of_birth', $data),
            self::pluckString('given_names', $data),
            self::pluckInteger('height', $data),
            self::pluckString('last_name', $data),
            self::pluckString('nationality', $data),
            self::pluckString('personal_identity_number', $data),
            self::pluckString('place_of_birth', $data),
            self::pluckString('sex', $data),
        );
    }
    
}

