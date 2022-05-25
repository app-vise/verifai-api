<?php

declare(strict_types=1);

namespace Appvise\Verifai\Model;

use DateTime;

final class MRZ
{
    // The dateOfBirthParsed only parses correctly when the age is lower than 100 year. There is no possibility to know if a date represents the 1900s or the 2000s since the year is denoted by two numbers in the MRZ.
    private $compositeCheckDigit; //	int	Check Digit
    private $countryCode; //	str	Country (Authority) code of documents origin
    private $countryCodeParsed; //	str	Country (Authority) code using the ISO 3166-1 alpha-3 codes.
    private $dateOfBirth; //	str	YYMMDD Birth date of the document holder
    private $dateOfBirthParsed; //	str	yyyy-mm-dd Birth date of the document holder parsed using the ISO 8601-standard.
    private $dateOfBirthCheckDigit; //	int	Check Digit
    private $dateOfExpiry; //	str	YYMMDD Expiry of the document
    private $dateOfExpiryParsed; //	str	yyyy-mm-dd Expiry of the document parsed using the ISO 8601-standard.
    private $dateOfExpiryCheckDigit; //	int	Check Digit
    private $documentNumber; //	str	Document number
    private $documentNumberCheckDigit; //	int	Check Digit
    private $documentSubType; //	str	Secondary document type
    private $documentType; //	str	Primary document type
    private $format; //	str	The MRZ Format
    private $givenNames; //	str	Given names of the document holder
    private $isCompositeValid; //	bool	Valid with Check Digit
    private $isDateOfBirthValid; //	bool	Valid with Check Digit
    private $isDateOfExpiryValid; //	bool	Valid with Check Digit
    private $isDateOfIssueValid; //	bool	Valid with Check Digit
    private $isDocumentCodeValid; //	bool	Valid with Check Digit
    private $isDocumentNumberValid; //	bool	Valid with Check Digit
    private $isLine1LengthValid; //	bool	Valid with Check Digit
    private $isLine2LengthValid; //	bool	Valid with Check Digit
    private $isLine3LengthValid; //	bool	Valid with Check Digit
    private $isNfcKeyValid; //	bool	Valid with Check Digit
    private $isOptionalDataValid; //	bool	Valid with Check Digit
    private $mrzString; //	str	The full MRZ using the ISO 3166-1 alpha-3 codes.
    private $nationality; //	str	Nationality of document holder
    private $nationalityParsed; //	str	Nationality of document holder
    private $nfcKey; //	str	Key to access the NFC chip
    private $optionalData; //	str	Depends on document and document authority. The < char is removed from the string.
    private $optionalDataCheckDigit; //	int	Check Digit
    private $optionalDataTwo; //	str	Depends on document and document authority. The < char is removed from the string.
    private $sex; //	str	Sex of document holder
    private $surname; //	str	Surname of document holder
    
    public function __construct(
        ?int $compositeCheckDigit,
        ?string $countryCode,
        ?string $countryCodeParsed,
        ?string $dateOfBirth,
        ?DateTime $dateOfBirthParsed,
        ?int $dateOfBirthCheckDigit,
        ?string $dateOfExpiry,
        ?DateTime $dateOfExpiryParsed,
        ?int $dateOfExpiryCheckDigit,
        ?string $documentNumber,
        ?int $documentNumberCheckDigit,
        ?string $documentSubtype,
        ?string $documentType,
        ?string $format,
        ?string $givenNames,
        ?bool $isCompositeValid,
        ?bool $isDateOfBirthValid,
        ?bool $isDateOfExpiryValid,
        ?bool $isDateOfIssueValid,
        ?bool $isDocumentCodeValid,
        ?bool $isDocumentNumberValid,
        ?bool $isLine1LengthValid,
        ?bool $isLine2LengthValid,
        ?bool $isLine3LengthValid,
        ?bool $isNfcKeyValid,
        ?bool $isOptionalDataValid,
        ?string $mrzString,
        ?string $nationality,
        ?string $nationalityParsed,
        ?string $nfcKey,
        ?string $optionalData,
        ?int $optionalDataCheckDigit,
        ?string $optionalDataTwo,
        ?string $sex,
        ?string $surname
    ) {
        $this->compositeCheckDigit = $compositeCheckDigit;
        $this->countryCode = $countryCode;
        $this->countryCodeParsed = $countryCodeParsed;
        $this->dateOfBirth = $dateOfBirth;
        $this->dateOfBirthParsed = $dateOfBirthParsed;
        $this->dateOfBirthCheckDigit = $dateOfBirthCheckDigit;
        $this->dateOfExpiry = $dateOfExpiry;
        $this->dateOfExpiryParsed = $dateOfExpiryParsed;
        $this->dateOfExpiryCheckDigit = $dateOfExpiryCheckDigit;
        $this->documentNumber = $documentNumber;
        $this->documentNumberCheckDigit = $documentNumberCheckDigit;
        $this->documentSubType = $documentSubtype;
        $this->documentType = $documentType;
        $this->format = $format;
        $this->givenNames = $givenNames;
        $this->isCompositeValid = $isCompositeValid;
        $this->isDateOfBirthValid = $isDateOfBirthValid;
        $this->isDateOfExpiryValid = $isDateOfExpiryValid;
        $this->isDateOfIssueValid = $isDateOfIssueValid;
        $this->isDocumentCodeValid = $isDocumentCodeValid;
        $this->isDocumentNumberValid = $isDocumentNumberValid;
        $this->isLine1LengthValid = $isLine1LengthValid;
        $this->isLine2LengthValid = $isLine2LengthValid;
        $this->isLine3LengthValid = $isLine3LengthValid;
        $this->isNfcKeyValid = $isNfcKeyValid;
        $this->isOptionalDataValid = $isOptionalDataValid;
        $this->mrzString = $mrzString;
        $this->nationality = $nationality;
        $this->nationalityParsed = $nationalityParsed;
        $this->nfcKey = $nfcKey;
        $this->optionalData = $optionalData;
        $this->optionalDataCheckDigit = $optionalDataCheckDigit;
        $this->optionalDataTwo = $optionalDataTwo;
        $this->sex = $sex;
        $this->surname = $surname;
    }

    public function toArray(): array
    {
        return [
            'givenNames' => $this->givenNames,
            'surname' => $this->surname,
            'sex' => $this->sex,
            'nationality' => $this->nationality,
            'nationalityParsed' => $this->nationalityParsed,
            'format' => $this->format,
            'compositeCheckDigit' => $this->compositeCheckDigit,
            'countryCode' => $this->countryCode,
            'countryCodeParsed' => $this->countryCodeParsed,
            'dateOfBirth' => $this->dateOfBirth,
            'dateOfBirthParsed' => $this->dateOfBirthParsed,
            'dateOfBirthCheckDigit' => $this->dateOfBirthCheckDigit,
            'dateOfExpiry' => $this->dateOfExpiry,
            'dateOfExpiryParsed' => $this->dateOfExpiryParsed,
            'dateOfExpiryCheckDigit' => $this->dateOfExpiryCheckDigit,
            'nfcKey' => $this->nfcKey,
            'documentNumber' => $this->documentNumber,
            'documentNumberCheckDigit' => $this->documentNumberCheckDigit,
            'documentSubType' => $this->documentSubType,
            'documentType' => $this->documentType,
            'optionalData' => $this->optionalData,
            'optionalDataCheckDigit' => $this->optionalDataCheckDigit,
            'optionalDataTwo' => $this->optionalDataTwo,
            'isCompositeValid' => $this->isCompositeValid,
            'isDateOfBirthValid' => $this->isDateOfBirthValid,
            'isDateOfExpiryValid' => $this->isDateOfExpiryValid,
            'isDateOfIssueValid' => $this->isDateOfIssueValid,
            'isDocumentCodeValid' => $this->isDocumentCodeValid,
            'isDocumentNumberValid' => $this->isDocumentNumberValid,
            'isLine1LengthValid' => $this->isLine1LengthValid,
            'isLine2LengthValid' => $this->isLine2LengthValid,
            'isLine3LengthValid' => $this->isLine3LengthValid,
            'isNfcKeyValid' => $this->isNfcKeyValid,
            'isOptionalDataValid' => $this->isOptionalDataValid,
            'mrzString' => $this->mrzString,
        ];
    }
}
