<?php

declare(strict_types=1);

namespace Appvise\Verifai\Model;

use DateTime;

class AbstractFactory
{
    protected static function pluckString($needle, $haystack): ?string
    {
        return self::extract($needle, $haystack);
    }

    protected static function pluckFloat($needle, $haystack): ?float
    {
        return (float)self::extract($needle, $haystack);
    }

    protected static function pluckInteger($needle, $haystack): ?int
    {
        return (int)self::extract($needle, $haystack);
    }

    protected static function pluckBoolean($needle, $haystack): ?bool
    {
        return (bool)self::extract($needle, $haystack);
    }

    protected static function pluckArray($needle, $haystack): ?array
    {
        return (array)self::extract($needle, $haystack);
    }

    protected static function pluckDate($needle, $haystack, $format = 'Ymd'): ?DateTime
    {
        $date = (string)self::extract($needle, $haystack);
        if (!$date) {
            return null;
        }
        return DateTime::createFromFormat($format, $haystack[$needle]);
    }

    private static function extract($needle, $haystack)
    {
        if (array_key_exists($needle, $haystack)) {
            return $haystack[$needle];
        }

        return null;
    }

    protected static function escape(string $string): string
    {
        if ($string !== null && strlen($string) > 0) {
            $string = addslashes($string);
        }
        return $string;
    }
}
