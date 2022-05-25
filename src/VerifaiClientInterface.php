<?php

declare(strict_types=1);

namespace Appvise\Verifai;

use Appvise\Verifai\Http\Body;
use Appvise\Verifai\Http\SessionId;

interface VerifaiClientInterface
{
    public function obtainOTP(Body $body);
    public function deleteSession(SessionId $sessionId);
    public function getVerifaiResult(SessionId $sessionId);
}
