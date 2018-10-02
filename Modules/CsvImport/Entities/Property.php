<?php declare(strict_types=1);

namespace Modules\CsvImport\Entities;

use Modules\CsvImport\Helpers\DateTimeTrait;

class Property
{
    use DateTimeTrait;

    /** @var int */
    private $id;
    /** @var string */
    private $title;
    /** @var Product */
    private $product;

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @param int $id
     *
     * @return $this;
     */
    public function setId(int $id): self
    {
        $this->id = $id;

        return $this;
    }

    /**
     * @return string
     */
    public function getTitle(): string
    {
        return $this->title;
    }

    /**
     * @param string $title
     *
     * @return $this;
     */
    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }

    /**
     * @return Product
     */
    public function getProduct(): Product
    {
        return $this->product;
    }

    /**
     * @param Product $product
     *
     * @return $this;
     */
    public function setProduct(Product $product): self
    {
        $this->product = $product;

        return $this;
    }
}
