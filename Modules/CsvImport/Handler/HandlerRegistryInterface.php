<?php declare(strict_types=1);

namespace Modules\CsvImport\Handler;

interface HandlerRegistryInterface
{
    /**
     * @param SubscribingHandlerInterface $handler
     *
     * @return void
     */
    public function registerSubscribingHandler(SubscribingHandlerInterface $handler);

    /**
     * Registers a handler in the registry.
     *
     * @param string $typeName
     * @param callable $handler function(VisitorInterface, mixed $data, array $type): mixed
     *
     * @return void
     */
    public function registerHandler(string $typeName, callable $handler);

    /**
     * @param string $typeName
     *
     * @return callable|null
     */
    public function getHandler($typeName);
}
