<?php

declare(strict_types=1);

namespace Appvise\Verifai\Model;

class VerifaiResultFactory extends AbstractFactory
{
    /**
     * @param array{profile:[], report:[], identity_document:[], person:[], processing_status:string, created:string, internal_reference:string, source:[]} $data 
     * @return VerifaiResult 
     */
    public static function fromArray(array $data): VerifaiResult
    {
        return new VerifaiResult(
            UUIDFactory::createUUID('profile', $data),
            ReportFactory::fromArray(self::pluckArray('report', $data)),
            IdentityDocumentFactory::fromArray(self::pluckArray('identity_document', $data)),
            PersonFactory::fromArray(self::pluckArray('person', $data)),
            self::pluckString('processing_status', $data),
            self::pluckDate('created', $data, 'Y-m-d\TH:i:s\.v\Z'),
            self::pluckString('internal_reference', $data),
            SourceFactory::fromArray(self::pluckArray('source', $data))
        );
    }

}
