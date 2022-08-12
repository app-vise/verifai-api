<?php

declare(strict_types=1);

namespace Appvise\Verifai\Model;

class Report
{
    /** @var string $status */
    private $status;
    /** @var null|string[] $reasons */
    private $reasons;

    /**
     * @param string $status 
     * @param null|string[] $reasons 
     * @return void 
     */
    public function __construct(string $status, ?array $reasons = null)
    {
        $this->status = $status;
        $this->reasons = $reasons;
    }

    public function getStatus(): string
    {
        return $this->status;
    }

    /** @return null|string[]  */
    public function getReasons(): ?array
    {
        return $this->reasons;
    }
}

