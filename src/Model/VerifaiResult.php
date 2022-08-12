<?php

declare(strict_types=1);

namespace Appvise\Verifai\Model;

use DateTime;

class VerifaiResult
{
    /** @var ProfileUUID $uuid  */
    private $uuid;
    /** @var Report $report  */
    private $report;
    /** @var IdentityDocument $identityDocument  */
    private $identityDocument;
    /** @var Person $person  */
    private $person;
    /** 
     * Signals whether the review is done and a profile was generated	"awaiting_data", "processing" or "completed"
     * @var string $processingStatus 
     **/
    private $processingStatus;
    /** @var DateTime $created  */
    private $created;
    /** @var string $internalReference  */
    private $internalReference;
    /** @var Source $source  */
    private $source;

    public function __construct(ProfileUUID $profileUUID, Report $report, IdentityDocument $identityDocument, Person $person, string $processingStatus, DateTime $created, string $internalReference, Source $source)
    {
        $this->uuid = $profileUUID;
        $this->report = $report;
        $this->identityDocument = $identityDocument;
        $this->person = $person;
        $this->processingStatus = $processingStatus;
        $this->created = $created;
        $this->internalReference = $internalReference;
        $this->source = $source;
    }

    public function getUuid(): ProfileUUID
    {
        return $this->uuid;
    }

    public function getReport(): Report
    {
        return $this->report;
    }

    public function getIdentityDocument(): IdentityDocument
    {
        return $this->identityDocument;
    }

    public function getPerson(): Person
    {
        return $this->person;
    }

    public function getProcessingStatus(): string
    {
        return $this->processingStatus;
    }

    public function getCreated(): DateTime
    {
        return $this->created;
    }

    public function getInternalReference(): string
    {
        return $this->internalReference;
    }

    public function getSource(): Source
    {
        return $this->source;
    }
}
