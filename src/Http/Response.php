<?php

declare(strict_types=1);

namespace Appvise\Verifai\Http;

use Appvise\Verifai\Model\VerifaiResult;

interface Response
{
    public function getStatusCode(): int;
    public function getData(): ?VerifaiResult;
}
