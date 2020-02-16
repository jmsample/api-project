<?php
declare(strict_types=1);

namespace JournalMedia\Sample\Repository;

use JournalMedia\Sample\Helpers\FileHelper;

class DemoRiverRepository extends RiverFactory implements RiverRepositoryInterface
{
    private $filePath;
    private $fileName;

    public function __construct($params)
    {
        $this->filePath = isset($params['path']) ? $params['path'] : getenv('DEMO_RESOURCE_PATH');
        $this->fileName = isset($params['defaultFileName']) ? $params['defaultFileName'] : getenv('DEMO_JOURNAL_FILE');;
    }

    /**
     * @inheritDoc
     */
    public function getPublications(string $slug = null): array
    {
        // journal path
        $fileName = $this->filePath . $this->fileName;
        // with slug
        if (!empty($slug)) {
            //get only by tag articles
            $fileName = $this->filePath . $slug . ".json";
        }

        $string = FileHelper::getFileContent($fileName);
        if (!empty($string)) {
            return json_decode($string, true);
        }
        return array();
    }

}
