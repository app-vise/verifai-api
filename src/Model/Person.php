<?php

declare(strict_types=1);

namespace Appvise\Verifai\Model;

class Person
{
    /** @var Family $family */
    private $family;
    /** @var Personal $personal */
    private $personal;
    /** @var Report $report */
    private $report;

    public function __construct(Family $family, Personal $personal, Report $report) {
        $this->family = $family;
        $this->personal = $personal;
        $this->report = $report;
    }

    public function getFamily(): Family
    {
        return $this->family;
    }

    public function getPersonal(): Personal
    {
        return $this->personal;
    }

    public function getReport(): Report
    {
        return $this->report;
    }
}
