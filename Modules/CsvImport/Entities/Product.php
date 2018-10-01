<?php declare(strict_types=1);

namespace Modules\CsvImport\Entities;

use Illuminate\Support\Collection;
use Modules\CsvImport\Helpers\DateTimeTrait;

class Product implements CsvConverterInterface
{
    use DateTimeTrait {
        DateTimeTrait::__construct as private __dtConstruct;
    }

    /** @var int */
    private $id;
    /** @var string */
    private $name;
    /** @var string */
    private $code;
    /** @var array */
    private $images;
    /** @var Collection|Property[] */
    private $properties;

    /**
     * Product constructor.
     */
    public function __construct()
    {
        $this->__dtConstruct();
        $this->properties = new Collection();
    }

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
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     *
     * @return $this;
     */
    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return string
     */
    public function getCode(): string
    {
        return $this->code;
    }

    /**
     * @param string $code
     *
     * @return $this;
     */
    public function setCode(string $code): self
    {
        $this->code = $code;

        return $this;
    }

    /**
     * @return array
     */
    public function getImages(): array
    {
        return $this->images;
    }

    /**
     * @param array $images
     *
     * @return $this;
     */
    public function setImages(array $images): self
    {
        $this->images = $images;

        return $this;
    }

    /**
     * @return Collection
     */
    public function getProperties(): Collection
    {
        return $this->properties;
    }

    /**
     * @param Collection $properties
     *
     * @return $this;
     */
    public function setProperties(Collection $properties): self
    {
        $this->properties = $properties;

        return $this;
    }

    /**
     * @return array
     */
    public function getColumnsMapping(): array
    {
        return [
            'B' => 'name',
            'D' => 'code',
            'E' => 'dateCreated',
        ];
    }
}
