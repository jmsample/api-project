<?php

namespace JournalMedia\Sample\ApiProject\Helpers;

use \Exception;

class FileHelper
{
    /**
     * @param string $filePath Path to the file
     */
    public function getFileContent(string $filePath): string
    {
        try {
            $this->fileExists($filePath);
            $this->fileIsReadable($filePath);
            return file_get_contents($filePath);
        }
        catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }

    /**
     * @param string $filePath Path to the file
     */
    public function fileExists(string $filePath): void
    {
        clearstatcache();
        if (!is_file($filePath)) {
            throw new Exception(sprintf('File "%s" not found.', $filePath));
        }
    }

    /**
     * @param string $filePath Path to the file
     */
    public function fileIsReadable(string $filePath)
    {
        clearstatcache();
        if (!is_readable($filePath)) {
            throw new Exception(sprintf('File "%s" is not readable.', $filePath));
        }
    }
}
