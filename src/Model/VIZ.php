<?php

declare(strict_types=1);

namespace Appvise\Verifai\Model;

final class VIZ
{
    private $dateOfBirth; //": "10 MAA/MAR 1965",
    private $dateOfExpiry; //": "09 MAA/MAR 2024",
    private $dateOfIssue; //": "09 MAA/MAR 2014",
    private $documentNumber; //": "SPECI2014",
    private $issuingAuth; //": "Burg. van Stad en Dorp",
    private $placeOfBirth; //": "Specimen",
    private $sex; //": "V/F"

    public function __construct(
        ?string $dateOfBirth,
        ?string $dateOfExpiry,
        ?string $dateOfissue,
        ?string $documentNumber,
        ?string $issuingAuth,
        ?string $placeOfBirth,
        ?string $sex
    ) {
        $this->dateOfBirth = $dateOfBirth;
        $this->dateOfExpiry = $dateOfExpiry;
        $this->dateOfIssue = $dateOfissue;
        $this->documentNumber = $documentNumber;
        $this->issuingAuth = $issuingAuth;
        $this->placeOfBirth = $placeOfBirth;
        $this->sex = $sex;
    }

    public  function toArray(): array
    {
        return [
            'dateOfBirth' => $this->dateOfBirth,
            'dateOfExpiry' => $this->dateOfExpiry,
            'dateOfIssue' => $this->dateOfIssue,
            'documentNumber' => $this->documentNumber,
            'issuingAuth' => $this->issuingAuth,
            'placeOfBirth' => $this->placeOfBirth,
            'sex' => $this->sex,
        ];
    }
}
