<?php
/**
 * Created by PhpStorm.
 * User: mpolak
 * Date: 19/11/2018
 * Time: 16:12
 */

namespace JournalMedia\Sample\Application;


trait ViewLoader {

    /**
     * Returns a .php or .html file to be rendered as a view
     *
     * @param string $name - the name of the file without the extension
     * @param string $baseDir - an alternative base directory
     * @return string
     *
     * @throws Exception If the file doesn't exist
     */
    public function loadView($name, $baseDir = null) {
        $baseDir = isset($baseDir) ? $baseDir : __DIR__ . '/../../resources/views/';
        $basePath = $baseDir . $name;

        if (!file_exists($baseDir)) {
            Throw new Exception('View directory not found.');
        }

        if (file_exists($basePath . '.php')) {
             return include $basePath . '.php';
        } else if (file_exists($basePath . 'html')) {
             include $basePath . 'html';
        } else {
            Throw new Exception('View file not found.');
        }
    }
}