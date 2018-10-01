<?php declare(strict_types=1);

namespace Modules\CsvImport\Parser;

use Modules\CsvImport\Entities\CsvConverterInterface;

class ObjectParser
{
    /** @var string */
    private $letter;
    /** @var CsvConverterInterface */
    private $object;

    /**
     * ObjectParser constructor.
     *
     * @param string                $letter
     * @param CsvConverterInterface $object
     */
    public function __construct(string $letter, CsvConverterInterface $object)
    {
        $this->letter = $letter;
        $this->object = $object;
    }


    public function hasColumn(): bool
    {
        return isset($this->object->getColumnsMapping()[$this->letter]);
    }

    public function getValue()
    {
        $methodName = $this->getGetterName();
        if (!method_exists($this->object, $methodName)) {
            throw new \RuntimeException(
                sprintf('Method %s is not implement in class %s', $methodName, get_class($this->object))
            );
        }

        return $this->object->{$methodName}();
    }

    private function getGetterName(): string
    {
        return 'get' . ucfirst($this->object->getColumnsMapping()[$this->letter]);
    }
}
