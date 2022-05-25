<?php

declare(strict_types=1);

namespace Appvise\Verifai\Http;

use Psr\Http\Message\ResponseInterface;

interface ClientInterface
{
    public function post(string $url, $body): ResponseInterface;
    public function get(string $url): ResponseInterface;
    public function delete(string $url): ResponseInterface;
}
