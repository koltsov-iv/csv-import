<?php declare(strict_types=1);

namespace Modules\CsvImport\Tests\Fixtures;

use Modules\CsvImport\Entities\Product;
use Modules\CsvImport\Helpers\RandomGeneratedValue;

class ProductFixture extends CollectionFixture
{
    /**
     * @return Product
     */
    public static function create(): Product
    {
        $result = (new Product())
            ->setId(RandomGeneratedValue::getUniqueInteger())
            ->setName(RandomGeneratedValue::getUniqueString())
            ->setCode(RandomGeneratedValue::getUniqueString())
            ->setImages(
                [
                    RandomGeneratedValue::getUniqueString(),
                    RandomGeneratedValue::getUniqueString(),
                ]
            );
        $result->setProperties(PropertyFixture::createCollectionByProduct($result));

        return $result;
    }
}
