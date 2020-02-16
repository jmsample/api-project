<?php

namespace JournalMedia\Sample\Helpers;

class FileHelper
{
    public static function getFileContent($fileName)
    {
        try {
            if (file_exists($fileName)) {
                return file_get_contents($fileName);
            }
        } catch (Exception $error) {
            return false;
        }
    }
}