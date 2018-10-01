<?php declare(strict_types=1);

namespace Modules\CsvImport\Handler;

class ColumnPosition
{
    public static $letterByPosition = [
        0 => 'A',
        1 => 'B',
        2 => 'C',
        3 => 'D',
        4 => 'E',
        5 => 'F',
        6 => 'G',
    ];

    public static function getPositionByLetter(string $letter): int
    {
        return array_search($letter, static::$letterByPosition);
    }
}