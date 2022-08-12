<?php

declare(strict_types=1);

namespace Appvise\Verifai\Model;

class Family
{
    /** @var string $fatherName  */
    private $fatherName;
    /** @var string $maidenName  */
    private $maidenName;
    /**
     * Legally defined marital state	Possible values: "single", "married", "widowed", "divorced", "separated", "registered partnership"
     * @var string $maritalStatus 
     **/
    private $maritalStatus;
    /** @var string $motherName  */
    private $motherName;
    /** @var string $spouseName  */
    private $spouseName;

    public function __construct(?string $fatherName, ?string $maidenName, ?string $maritalStatus, ?string $motherName, ?string $spouseName)
    {
        $this->fatherName = $fatherName;
        $this->maidenName = $maidenName;
        $this->maritalStatus = $maritalStatus;
        $this->motherName = $motherName;
        $this->spouseName = $spouseName;
    }

    public function getFatherName(): ?string
    {
        return $this->fatherName;
    }

    public function getMaidenName(): ?string
    {
        return $this->maidenName;
    }

    public function getMaritalStatus(): ?string
    {
        return $this->maritalStatus;
    }

    public function getMotherName(): ?string
    {
        return $this->motherName;
    }

    public function getSpouseName(): ?string
    {
        return $this->spouseName;
    }
}
