<?php

declare(strict_types=1);

namespace Appvise\Verifai\Http;

use Appvise\Verifai\Exception\NotFoundException;
use Appvise\Verifai\Exception\VerifaiApiException;
use Appvise\Verifai\Exception\NotAuthenticatedException;

class ExceptionHandler
{
    public static function handle($exception)
    {
        switch ($exception->getCode()) {
            case '404':
                throw new NotFoundException();
                break;
            case '401':
                throw new NotAuthenticatedException();
                break;
            default:
                throw new VerifaiApiException();
                break;
        }
    }
}
