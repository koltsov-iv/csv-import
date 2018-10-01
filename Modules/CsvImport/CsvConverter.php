<?php declare(strict_types=1);

namespace Modules\CsvImport;

use Illuminate\Support\Collection;
use Modules\CsvImport\Entities\CsvConverterInterface;
use Modules\CsvImport\Entities\CsvHasHeaderInterface;
use Modules\CsvImport\Handler\ColumnPosition;
use Modules\CsvImport\Helpers\TmpFileService;
use Modules\CsvImport\Parser\ObjectParser;

class CsvConverter
{
    /** @var CsvNavigator */
    private $csvNavigator;

    /**
     * CsvConverter constructor.
     *
     * @param CsvNavigator $csvNavigator
     */
    public function __construct(CsvNavigator $csvNavigator)
    {
        $this->csvNavigator = $csvNavigator;
    }

    /**
     * @param Collection $collection
     *
     * @return \SplFileObject
     */
    public function convertCollection(Collection $collection): \SplFileObject
    {
        $result = (new TmpFileService())->createFile()->openFile('w');
        foreach ($collection as $row) {
            $result->fputcsv($this->toArray($row));
        }

        return $result;
    }

    /**
     * @param CsvConverterInterface $data
     *
     * @return array
     */
    public function toArray(CsvConverterInterface $data): array
    {
        $result = [];
        if ($data instanceof CsvHasHeaderInterface) {
            $result[] = $data->getHeaderMapping();
        }

        foreach (ColumnPosition::$letterByPosition as $position => $letter) {
            $objectParser = new ObjectParser($letter, $data);
            if (!$objectParser->hasColumn()) {
                $result[$position] = '';
                continue;
            }

            $result[$position] = $this->csvNavigator->accept($objectParser->getValue());
        }

        return $result;
    }
}
