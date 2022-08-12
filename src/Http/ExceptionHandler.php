<?php

declare(strict_types=1);

namespace Appvise\Verifai\Http;

use Appvise\Verifai\Exception\NotFoundException;
use Appvise\Verifai\Exception\VerifaiApiException;
use Appvise\Verifai\Exception\NotAuthenticatedException;
use Exception;

class ExceptionHandler
{
    public static function handle(Exception $exception): Exception
    {
        switch ($exception->getCode()) {
            case '404':
                throw new NotFoundException();
            case '401':
                throw new NotAuthenticatedException();
            default:
                throw new VerifaiApiException();
        }
    }
}
