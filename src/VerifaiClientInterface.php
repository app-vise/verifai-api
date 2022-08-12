<?php

declare(strict_types=1);

namespace Appvise\Verifai;

use Appvise\Verifai\Http\Body;
use Appvise\Verifai\Http\VerifaiResponse;
use Appvise\Verifai\Model\OneTimePassword;
use Appvise\Verifai\Model\UUID;

interface VerifaiClientInterface
{
    public function obtainOTP(Body $body): OneTimePassword;
    public function getVerifaiResult(UUID $profileUuid): VerifaiResponse;
}
