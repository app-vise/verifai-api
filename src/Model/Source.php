<?php

declare(strict_types=1);

namespace Appvise\Verifai\Model;

class Source
{
    /** @var IdentifierUUID $identifierUuid  */
    private $identifierUuid;
    /** @var string $inputApplication */
    private $inputApplication;
    /** @var string $inputVersion */
    private $inputVersion;
    /** @var string $userAgent */
    private $userAgent;

    public function __construct(IdentifierUUID $identifierUUID, string $inputApplication, string $inputVersion, string $userAgent)
    {
        $this->identifierUuid = $identifierUUID;
        $this->inputApplication = $inputApplication;
        $this->inputVersion = $inputVersion;
        $this->userAgent = $userAgent;
    }

    public function getIdentifierUuid(): IdentifierUUID
    {
        return $this->identifierUuid;
    }

    public function getInputApplication(): string
    {
        return $this->inputApplication;
    }

    public function getInputVersion(): string
    {
        return $this->inputVersion;
    }

    public function getUserAgent(): string
    {
        return $this->userAgent;
    }
}
