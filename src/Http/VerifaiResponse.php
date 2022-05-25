<?php

declare(strict_types=1);

namespace Appvise\Verifai\Http;

use Appvise\Verifai\Model\VerifaiResult;

class VerifaiResponse implements Response
{
    private $statusCode;
    private $data;

    public function __construct(int $statusCode, $data = null)
    {
        $this->statusCode = $statusCode;
        $this->data = $data;
    }

    public function getStatusCode(): int
    {
        return (int)$this->statusCode;
    }

    public function getData(): ?VerifaiResult
    {
        return $this->data;
    }
}
