<?php

namespace JournalMedia\Sample\Service;

use JournalMedia\Sample\Service\DataService;

/**
 * Class LocalService
 * @package JournalMedia\Sample\Service
 */
class LocalService extends DataService
{
    /**
     * Fetch articles from local file
     *
     * @return array
     */
    public function fetch(): array
    {
        try {
            if (file_exists($this->getFilePath())) {
                $jsonData = file_get_contents($this->getFilePath());
                $jsonData = json_decode($jsonData);

                return is_array($jsonData) ? $jsonData : [];
            }
        } catch (Exception $e) {

        }

        return [];
    }

    /**
     * Get local file path
     *
     * @return mixed
     */
    public function getFilePath()
    {
        $filePath = getenv('LOCAL_FILES_PATH');
        $tagFile = empty($this->getTag()) ? "" : $this->getTag() . '.json';

        if (!empty($tagFile)) {
            return $filePath . $tagFile;
        }

        return $filePath . $this->getPublication() . ".json";
    }
}