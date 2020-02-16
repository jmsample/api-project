<?php
declare(strict_types=1);

namespace JournalMedia\Sample\Repository;

use JournalMedia\Sample\Helpers\FileHelper;


class DemoRiverRepository extends RiverFactory implements RiverRepositoryInterface
{

    private $filePath;
    private $fileName;

    public function __construct($path, $homeFile)
    {
        $this->filePath = $path;
        $this->fileName = $homeFile;
    }

    /**
     * @inheritDoc
     */
    public function getPublications(string $slug = null): array
    {
        // Implement getPublications() method.
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
