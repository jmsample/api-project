<?php

namespace JournalMedia\Sample\ApiProject\Services;

use JournalMedia\Sample\ApiProject\Helpers\FileHelper;
use JournalMedia\Sample\ApiProject\Helpers\PathHelper;
use JournalMedia\Sample\ApiProject\Helpers\JsonHelper;
use \Exception;

class LocalApiService
{
    private FileHelper $fileHelper;
    private JsonHelper $jsonHelper;
    private string $resourceBasePath;

    public function __construct(FileHelper $fileHelper, JsonHelper $jsonHelper)
    {
        $this->fileHelper = $fileHelper;
        $this->jsonHelper = $jsonHelper;
        $this->resourceBasePath = $this->setResourceBasePath();
    }

    private function setResourceBasePath(): string
    {
        return sprintf('%s/resources/demo-responses', PathHelper::basePath());
    }

    /**
     * Get a list of articles
     */
    public function getArticles(): array
    {
        $articles = $this->fileHelper->getFileContent("{$this->resourceBasePath}/thejournal.json");
        return $this->jsonHelper->toJson($articles);
    }

    /**
     * Get a subset of articles filtered by a tag
     * 
     * @param string $tag The tag to filter the articles on
     */
    public function getArticlesByTag(string $tag): array
    {
        try {
            $articles = $this->fileHelper->getFileContent("{$this->resourceBasePath}/${tag}.json");
        }
        catch(Exception) {
            return [];
        }
        
        return $this->jsonHelper->toJson($articles);
    }
}
