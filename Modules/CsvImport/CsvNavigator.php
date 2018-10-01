<?php declare(strict_types=1);

namespace Modules\CsvImport;

use Modules\CsvImport\Handler\HandlerRegistryInterface;

class CsvNavigator
{
    /** @var CsvVisitor */
    private $visitor;
    /** @var HandlerRegistryInterface */
    private $handlerRegistry;

    /**
     * CsvNavigator constructor.
     *
     * @param CsvVisitor               $visitor
     * @param HandlerRegistryInterface $handlerRegistry
     */
    public function __construct(CsvVisitor $visitor, HandlerRegistryInterface $handlerRegistry)
    {
        $this->visitor = $visitor;
        $this->handlerRegistry = $handlerRegistry;
    }

    /**
     * @param            $data
     * @param array|null $type
     *
     * @return mixed
     */
    public function accept($data, array $type = null)
    {
        if (null === $type) {
            $typeName = \gettype($data);
            $type = ['name' => $typeName, 'params' => []];
        }

        switch ($type['name']) {
            case 'NULL':
                return $this->visitor->visitNull();

            case 'string':
                return $this->visitor->visitString($data);

            case 'int':
            case 'integer':
                return $this->visitor->visitInteger($data);

            case 'bool':
            case 'boolean':
                return $this->visitor->visitBoolean($data);

            case 'double':
            case 'float':
                return $this->visitor->visitDouble($data);

            case 'array':
            case 'resource':
            case 'object':
            default:
                if ($type['name'] == 'object') {
                    $type['name'] = get_class($data);
                }

                if (null !== $handler = $this->handlerRegistry->getHandler($type['name'])) {
                    return \call_user_func($handler, $data);
                }

                throw new \RuntimeException(sprintf('Type %s is not implement for convert', $type['name']));
        }
    }
}