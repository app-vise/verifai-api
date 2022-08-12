<?php

declare(strict_types=1);

namespace Appvise\Verifai\Model;

use DateTime;

abstract class AbstractFactory
{

    /**
     * @param string $needle 
     * @param string[] $haystack 
     * @return null|string 
     */
    protected static function pluckString(string $needle, array $haystack): ?string
    {
        return self::extract($needle, $haystack);
    }

    /**
     * @param string $needle 
     * @param string[] $haystack 
     * @return null|float 
     */
    protected static function pluckFloat(string $needle, array $haystack): ?float
    {
        return (float)self::extract($needle, $haystack);
    }

    /**
     * @param string $needle 
     * @param string[] $haystack 
     * @return null|int 
     */
    protected static function pluckInteger(string $needle, array $haystack): ?int
    {
        return (int)self::extract($needle, $haystack);
    }

    /**
     * @param string $needle 
     * @param string[] $haystack 
     * @return null|bool 
     */
    protected static function pluckBoolean(string $needle, array $haystack): ?bool
    {
        return (bool)self::extract($needle, $haystack);
    }

    /**
     * @param string $needle 
     * @param string[] $haystack 
     * @return null|array 
     */
    protected static function pluckArray(string $needle, array $haystack): ?array
    {
        return (array)self::extract($needle, $haystack);
    }

    /**
     * @param string $needle 
     * @param string[] $haystack 
     * @param null|string $format 
     * @return null|DateTime 
     */
    protected static function pluckDate(string $needle, array $haystack, ?string $format = 'Y-m-d'): ?DateTime
    {
        $dateString = (string)self::extract($needle, $haystack);
        if (!$dateString) {
            return null;
        }
        return DateTime::createFromFormat($format, $dateString);
    }

    /**
     * @param string $needle 
     * @param string[] $haystack 
     * @return mixed 
     */
    private static function extract(string $needle, array $haystack)
    {
        if (array_key_exists($needle, $haystack)) {
            return $haystack[$needle];
        }
        return null;
    }
}
