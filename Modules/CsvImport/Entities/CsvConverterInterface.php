<?php declare(strict_types=1);

namespace Modules\CsvImport\Entities;

interface CsvConverterInterface
{
    public function getColumnsMapping(): array;
}
