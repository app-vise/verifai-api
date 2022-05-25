<?php

declare(strict_types=1);

namespace Appvise\Verifai\Model;

use DateTime;

final class OneTimePassword
{
    private $token;
    private $expire;
    private $used;

    public function __construct(string $token, string $expire, bool $used)
    {
        $this->token = $token;
        $this->expire = new DateTime($expire);
        $this->used = $used;
    }
    
    public function token(): string
    {
        return $this->token;
    }

    public function expires(): DateTime
    {
        return $this->expire;
    }

    public function hasBeenUsed(): bool
    {
        return (bool)$this->used;
    }
}
