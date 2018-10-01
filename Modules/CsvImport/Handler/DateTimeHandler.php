<?php declare(strict_types=1);

namespace Modules\CsvImport\Handler;

class DateTimeHandler implements SubscribingHandlerInterface
{
    private $defaultFormat;

    /**
     * DateTimeHandler constructor.
     *
     * @param $defaultFormat
     */
    public function __construct($defaultFormat = \DateTime::ISO8601)
    {
        $this->defaultFormat = $defaultFormat;
    }

    /**
     * @inheritdoc
     */
    public static function getSubscribingMethods(): array
    {
        return [
            [
                'type'   => 'DateTime',
                'method' => 'serializeDateTime',
            ],
        ];
    }

    public function serializeDateTime(\DateTime $date): string
    {
        return $date->format($this->defaultFormat);
    }
}
