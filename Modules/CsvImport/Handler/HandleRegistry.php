<?php declare(strict_types=1);

namespace Modules\CsvImport\Handler;

class HandleRegistry implements HandlerRegistryInterface
{
    /**
     * @var array|SubscribingHandlerInterface[]
     */
    protected $handlers;

    /**
     * HandleRegistry constructor.
     *
     * @param array $handlers
     */
    public function __construct(array $handlers = [])
    {
        $this->handlers = $handlers;
    }

    /**
     * @param SubscribingHandlerInterface $handler
     */
    public function registerSubscribingHandler(SubscribingHandlerInterface $handler): void
    {
        foreach ($handler->getSubscribingMethods() as $methodData) {
            if (!isset($methodData['type'])) {
                throw new \RuntimeException(
                    sprintf(
                        'For each subscribing method a "type" attribute must be given, but only got "%s" for %s.',
                        $methodData['type'],
                        \get_class($handler)
                    )
                );
            }


            $this->registerHandler($methodData['type'], [$handler, $methodData['method']]);
        }
    }

    /**
     * @param string   $typeName
     * @param callable $handler
     */
    public function registerHandler(string $typeName, callable $handler)
    {
        $this->handlers[$typeName] = $handler;
    }

    /**
     * @param $typeName
     *
     * @return SubscribingHandlerInterface|null
     */
    public function getHandler($typeName)
    {
        if (!isset($this->handlers[$typeName])) {
            return null;
        }

        return $this->handlers[$typeName];
    }
}
