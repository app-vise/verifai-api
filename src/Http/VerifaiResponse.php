<?php

declare(strict_types=1);

namespace Appvise\Verifai\Http;

use Appvise\Verifai\Model\VerifaiResult;

class VerifaiResponse implements Response
{
    /** @var int $statusCode */
    private $statusCode;
    /** @var ?VerifaiResult $data */
    private $data;

    public function __construct(int $statusCode, ?VerifaiResult $data = null)
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
