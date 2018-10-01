<?php declare(strict_types=1);

namespace Modules\CsvImport\Handler;

interface SubscribingHandlerInterface
{
    /**
     * Return format:
     *
     *      array(
     *          array(
     *              'type' => 'DateTime',
     *              'method' => 'serializeDateTime',
     *          ),
     *      )
     *
     * The direction and method keys can be omitted.
     *
     * @return array
     */
    public static function getSubscribingMethods(): array;
}
