<?php

declare(strict_types=1);

namespace Appvise\Verifai\Model;

class PersonFactory extends AbstractFactory
{

    /**
     * @param array{family:string[], personal:string[],report:string[]} $data 
     * @return Person 
     */
    public static function fromArray(array $data): Person
    {
        return new Person(
            FamilyFactory::fromArray(self::pluckArray('family', $data)),
            PersonalFactory::fromArray(self::pluckArray('personal', $data)),
            ReportFactory::fromArray(self::pluckArray('report', $data)),
        );
    }
}
