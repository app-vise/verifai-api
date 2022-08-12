<?php

declare(strict_types=1);

namespace Appvise\Verifai\Model;

class IdentityDocument
{
    /** @var Data $data */
    private $data;
    /** @var Page[] $pages */
    private $pages;
    /** @var Report $report */
    private $report;

    /**
     * @param Data $data 
     * @param Page[] $pages 
     * @param Report $report 
     * @return void 
     */
    public function __construct(Data $data, array $pages, Report $report) {
        $this->data = $data;
        $this->pages = $pages;
        $this->report = $report;
    }

    public function getData(): Data
    {
        return $this->data;
    }

    /** @return Page[]  */
    public function getPages(): array
    {
        return $this->pages;
    }

    public function getReport(): Report
    {
        return $this->report;
    }
}

