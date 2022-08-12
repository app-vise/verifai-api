<?php

declare(strict_types=1);

namespace Appvise\Verifai\Model;

class SourceFactory extends AbstractFactory
{
    /**
     * @param array{identifier:string, input_application:string, input_version:string, user_agent:string} $data 
     * @return Source 
     */
    public static function fromArray(array $data): Source
    {
        return new Source(
            UUIDFactory::createUUID('identifier', $data),
            self::pluckString('input_application', $data),
            self::pluckString('input_version', $data),
            self::pluckString('user_agent', $data),
        );
    }
    
}

