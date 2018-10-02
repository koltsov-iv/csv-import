<?php declare(strict_types=1);

namespace Modules\CsvImport\Helpers;

class RandomGeneratedValue
{
    /**
     * @return int
     */
    public static function getUniqueInteger() : int
    {
        return rand();
    }

    /**
     * @return string
     */
    public static function getUniqueString() : string
    {
        return uniqid();
    }
}
