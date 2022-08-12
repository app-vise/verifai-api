<?php

declare(strict_types=1);

namespace Appvise\Verifai\Model;

final class WebhookData
{
    /** @var ProfileUUID $profileUuid */
    private $profileUuid;
    /** @var string $processingStatus */
    private $processingStatus;
    /** @var string $internalReference */
    private $internalReference;
    
    public function __construct(ProfileUUID $profileUuid, string $processingStatus, ?string $internalReference)
    {
        $this->profileUuid = $profileUuid;
        $this->processingStatus = $processingStatus;
        $this->internalReference = $internalReference;
    }
    
    public function getProfileUuid(): ProfileUUID
    {
        return $this->profileUuid;
    }

    public function getProcessingStatus(): string
    {
        return $this->processingStatus;
    }

    public function getInternalReference(): ?string
    {
        return $this->internalReference;
    }
}

