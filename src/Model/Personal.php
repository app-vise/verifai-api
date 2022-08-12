<?php

declare(strict_types=1);

namespace Appvise\Verifai\Model;

use DateTime;

class Personal
{

    /** @var null|DateTime $dateOfBirth  */
    private $dateOfBirth;
    /** @var null|string $givenNames  */
    private $givenNames;
    /**
     * Height in centimeters 
     * @var null|int $height  
     **/
    private $height;
    /** @var null|string $lastName  */
    private $lastName;
    /**
     * Alpha-3 country code "NLD" 
     * @var null|string $nationality  
     **/
    private $nationality;
    /** @var null|string $personalIdentityNumber  */
    private $personalIdentityNumber;
    /** @var null|string $placeOfBirth  */
    private $placeOfBirth;
    /**
     * Sex of the person as on the document	"female", "male", "other"
     * @var null|string $sex  
     **/
    private $sex;

    public function __construct(?DateTime $dateOfBirth, ?string $givenNames, ?int $height, ?string $lastName, ?string $nationality, ?string $personalIdentityNumber, ?string $placeOfBirth, ?string $sex)
    {
        $this->dateOfBirth = $dateOfBirth;
        $this->givenNames = $givenNames;
        $this->height = $height;
        $this->lastName = $lastName;
        $this->nationality = $nationality;
        $this->personalIdentityNumber = $personalIdentityNumber;
        $this->placeOfBirth = $placeOfBirth;
        $this->sex = $sex;
    }

    public function getDateOfBirth(): ?DateTime
    {
        return $this->dateOfBirth;
    }

    public function getGivenNames(): ?string
    {
        return $this->givenNames;
    }

    public function getHeight(): ?int
    {
        return $this->height;
    }

    public function getLastName(): ?string
    {
        return $this->lastName;
    }

    public function getNationality(): ?string
    {
        return $this->nationality;
    }

    public function getPersonalIdentityNumber(): ?string
    {
        return $this->personalIdentityNumber;
    }

    public function getPlaceOfBirth(): ?string
    {
        return $this->placeOfBirth;
    }

    public function getSex(): ?string
    {
        return $this->sex;
    }
}
