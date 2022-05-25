<?php

declare(strict_types=1);

namespace Appvise\Verifai\Http;

class SessionId
{
    private $id;

    public function __construct(string $id)
    {
        $this->id = $id;
    }

    public function value()
    {
        return $this->id;
    }
}
