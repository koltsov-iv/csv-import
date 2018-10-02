<?php declare(strict_types=1);

namespace Modules\CsvImport\Tests\Fixtures;

use Illuminate\Support\Collection;
use Modules\CsvImport\Entities\Product;
use Modules\CsvImport\Entities\Property;
use Modules\CsvImport\Helpers\RandomGeneratedValue;

class PropertyFixture extends CollectionFixture
{
    /**
     * @return Property
     */
    public static function create(): Property
    {
        return (new Property())->setId(RandomGeneratedValue::getUniqueInteger())
                               ->setTitle(RandomGeneratedValue::getUniqueString());
    }

    /**
     * @param Product $product
     *
     * @return Collection
     */
    public static function createCollectionByProduct(Product $product): Collection
    {
        /** @var Collection|Property[] $result */
        $result = self::createCollection();
        foreach ($result as $row) {
            $row->setProduct($product);
        }

        return $result;
    }
}
