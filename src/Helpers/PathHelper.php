<?php

namespace JournalMedia\Sample\ApiProject\Helpers;

class PathHelper
{
    /**
     * Base path of the application
     */
    public static function basePath(): string
    {
        return dirname(self::publicPath(), 1);
    }

    /**
     * Public directory path of the application
     */
    public static function publicPath(): string
    {
        return $_SERVER['DOCUMENT_ROOT'];
    }
}
