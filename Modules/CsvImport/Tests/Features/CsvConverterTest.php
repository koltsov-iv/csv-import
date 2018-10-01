<?php

namespace Modules\CsvImport\Tests\Features;

use Modules\CsvImport\CsvConverter;
use Modules\CsvImport\CsvNavigator;
use Modules\CsvImport\CsvVisitor;
use Modules\CsvImport\Handler\DateTimeHandler;
use Modules\CsvImport\Handler\HandleRegistry;
use Modules\CsvImport\Tests\Fixtures\ProductFixture;
use Tests\TestCase;

class CsvConverterTest extends TestCase
{
    /** @var CsvConverter */
    private $csvConverter;

    protected function setUp()
    {
        parent::setUp();
        $handleRegistry = new HandleRegistry();
        $handleRegistry->registerSubscribingHandler(new DateTimeHandler());
        $navigator = new CsvNavigator(new CsvVisitor(), $handleRegistry);
        $this->csvConverter = new CsvConverter($navigator);
    }

    public function test_toCsv_withProductFixutre_shouldReturnArray()
    {
        $product = ProductFixture::create();
        $result = $this->csvConverter->toArray($product);
        $this->assertNotEmpty($result);
    }

    public function test_convertCollection_withProductCollection_shouldReturnFile()
    {
        $product = ProductFixture::createCollection();
        $result = $this->csvConverter->convertCollection($product);
        $this->assertInstanceOf(\SplFileObject::class, $result);
    }
}

