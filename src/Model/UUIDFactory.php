<?php

declare(strict_types=1);

namespace Appvise\Verifai\Model;

use Appvise\Verifai\Model\AbstractFactory;
use Appvise\Verifai\Model\IdentifierUUID;
use Appvise\Verifai\Model\ProfileUUID;
use Exception;

class UUIDFactory extends AbstractFactory
{

    /**
     * @param string $type 
     * @param string[] $data
     * @return UUID 
     */
    public static function createUUID(string $type, array $data): UUID
    {
        switch ($type) {
            case 'profile_uuid':
                return ProfileUUID::make(self::pluckString('profile_uuid', $data));
            case 'profile':
                return ProfileUUID::make(self::pluckString('uuid', $data));
            case 'identifier':
                return IdentifierUUID::make(self::pluckString('identifier_uuid', $data));
            default:
                throw new Exception('Not a known UUID');
        }
    }
}
