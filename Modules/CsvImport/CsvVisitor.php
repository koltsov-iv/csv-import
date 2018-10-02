<?php declare(strict_types=1);

namespace Modules\CsvImport;

class CsvVisitor
{

    public function visitNull()
    {
        return null;
    }

    public function visitString($data): string
    {
        return (string)$data;
    }

    public function visitBoolean($data): bool
    {
        return (bool)$data;
    }

    public function visitInteger($data): int
    {
        return (int)$data;
    }

    public function visitDouble($data): float
    {
        return (float)$data;
    }
}
