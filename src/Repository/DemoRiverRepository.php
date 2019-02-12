<?php

namespace JournalMedia\Sample\Repository;

use Exception;
use JournalMedia\Sample\Factory\RiverFactory;

class DemoRiverRepository implements RiverRepositoryInterface
{

    /**
     * @return array
     * @throws Exception
     */
    public function getForPublication()
    {
        return $this->getFileResponse('thejournal');
    }

    /**
     * @param string $tag
     * @return array
     * @throws Exception
     */
    public function getForTag(string $tag)
    {
        return $this->getFileResponse($tag);
    }

    /**
     * Fetch the articles from files and return a array of River from the articles
     * @param null $filename
     * @return array
     * @throws Exception
     */
    private function getFileResponse($filename = null) {
        $filepath = dirname(__DIR__ , 2)  . '/resources/demo-responses/' . $filename . '.json';

        if (!file_exists($filepath)) {
            throw new Exception('The file who contain the data doesn\'t exist');
        }

        $file_content = file_get_contents($filepath);
        $json_datas = json_decode($file_content);

        return RiverFactory::fromSerializedArticles($json_datas);
    }
}
