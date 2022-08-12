<?php

declare(strict_types=1);

namespace Appvise\Verifai\Model;

use DateTime;

class Data
{
    /** 
     * Alpha 3 country code
     * @var string $country  */
    private $country;
    /** @var DateTime $dateOfExpiry  */
    private $dateOfExpiry;
    /** @var DateTime $dateOfIssue  */
    private $dateOfIssue;
    /** @var string $documentNumber  */
    private $documentNumber;
    /** @var string $issuingAuthority  */
    private $issuingAuthority;
    /** @var string[] $mrzLines  */
    private $mrzLines;
    /** @var string $placeOfIssue  */
    private $placeOfIssue;

    public function __construct(?string $country, ?DateTime $dateOfExpiry, ?DateTime $dateOfIssue, ?string $documentNumber, ?string $issuingAuthority, ?array $mrzLines, ?string $placeOfIssue)
    {
        $this->country = $country;
        $this->dateOfExpiry = $dateOfExpiry;
        $this->dateOfIssue = $dateOfIssue;
        $this->documentNumber = $documentNumber;
        $this->issuingAuthority = $issuingAuthority;
        $this->mrzLines = $mrzLines;
        $this->placeOfIssue = $placeOfIssue;
    }

    public function getCountry(): ?string
    {
        return $this->country;
    }

    public function getDateOfExpiry(): ?DateTime
    {
        return $this->dateOfExpiry;
    }

    public function getDateOfIssue(): ?DateTime
    {
        return $this->dateOfIssue;
    }

    public function getDocumentNumber(): ?string
    {
        return $this->documentNumber;
    }

    public function getIssuingAuthority(): ?string
    {
        return $this->issuingAuthority;
    }

    public function getMrzLines(): array
    {
        return $this->mrzLines;
    }

    public function getPlaceOfIssue(): ?string
    {
        return $this->placeOfIssue;
    }
}
