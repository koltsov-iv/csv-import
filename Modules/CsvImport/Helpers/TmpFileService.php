<?php declare(strict_types=1);

namespace Modules\CsvImport\Helpers;

use Symfony\Component\HttpFoundation\File\File;

class TmpFileService
{
    /** @var string */
    private $tmpDir = '/tmp/';

    /** @var File */
    private $file = NULL;

    /**
     * @param string $content
     *
     * @return File
     */
    public function createFile($content = '')
    {
        if (is_null($this->file)) {
            $filePath = tempnam($this->tmpDir, '');
        } else {
            $filePath = $this->file->getRealPath();
        }

        $fp = fopen($filePath, 'w');
        fwrite($fp, $content);
        fclose($fp);

        $this->file = new File($filePath);

        return $this->file;
    }

    public function setContent($content)
    {
        if (empty($this->file)) {
            throw new \Exception('File is empty');
        }

        $fp = fopen($this->file->getRealPath(), 'w');
        fwrite($fp, $content);
        fclose($fp);
    }

    /**
     * @return File
     */
    public function getFile()
    {
        return $this->file;
    }

    /**
     * @void
     */
    public function deleteFile()
    {
        @unlink($this->file->getRealPath());
        $this->file = NULL;
    }

    /**
     * Use this function carefully !!!
     */
    public function clearAllFiles()
    {
        foreach (scandir($this->tmpDir) as $row) {
            if (is_dir($this->tmpDir . DIRECTORY_SEPARATOR . $row)) {
                continue;
            }

            @unlink($this->tmpDir . DIRECTORY_SEPARATOR . $row);
        }
    }
}