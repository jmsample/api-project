<?php

namespace JournalMedia\Sample\ApiProject\Service;

class RiverFileDataSource implements RiverDataSourceInterface
{
    const RESOURCES_EXTENSION = 'json';

    private string $riverSourceBasePath;

    public function __construct(string $riverSourceBasePath)
    {
        $this->riverSourceBasePath = $riverSourceBasePath;
    }

    public function getArticlesByPublication(string $publicationName, array $extraOptions = [])
    {
        $resourcePath = $this->riverSourceBasePath . DIRECTORY_SEPARATOR .
            $publicationName . '.' . self::RESOURCES_EXTENSION;
        return $this->getAndParseDataFromFile($resourcePath);
    }

    public function getArticlesByTag(string $tagName, array $extraOptions = [])
    {
        $resourcePath = $this->riverSourceBasePath . DIRECTORY_SEPARATOR .
            $tagName . '.' . self::RESOURCES_EXTENSION;
        return $this->getAndParseDataFromFile($resourcePath);
    }

    /**
     * @param string $resourcePath
     * @return array|mixed
     */
    private function getAndParseDataFromFile(string $resourcePath): mixed
    {
        if ($result = file_get_contents($resourcePath)) {
            return json_decode($result, true);
        } else {
            return [];
        }
    }
}