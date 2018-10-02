<?php declare(strict_types=1);

namespace Modules\CsvImport\Tests\Fixtures;

use Illuminate\Support\Collection;

abstract class CollectionFixture
{
    const COLLECTION_MIN = 3;
    const COLLECTION_MAX = 30;

    /**
     * @return Collection
     */
    public static function createCollection(): Collection
    {
        $collectionCount = rand(self::COLLECTION_MIN, self::COLLECTION_MAX);

        return self::createCollectionByCount($collectionCount);
    }

    /**
     * @param int $count
     *
     * @return Collection
     */
    public static function createCollectionByCount(int $count): Collection
    {
        $result = new Collection();
        for ($i = 0; $i < $count; $i++) {
            $result->push(static::create());
        }

        return $result;
    }

    abstract public static function create();
}
