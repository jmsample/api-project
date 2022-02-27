<?php
namespace JournalMedia\Sample\ApiProject\Services;

use JournalMedia\Sample\ApiProject\Services\JournalApiService;
use JournalMedia\Sample\ApiProject\Services\LocalApiService;

class ArticleService
{
    private JournalApiService $apiService;
    private LocalApiService $localApiService;
    private string $dataSource;

    public function __construct(
        JournalApiService $apiService,
        LocalApiService $localApiService,
    ) {
        $this->apiService = $apiService;
        $this->localApiService = $localApiService;
        $this->dataSource = getenv('DEMO_MODE') === 'true' ? 'local' : 'api';
    }

    /**
     * Get a list of articles
     */
    public function getArticles(): array
    {
        if ($this->dataSource === 'api') {
            $articles = $this->apiService->get('thejournal');
            return $articles['response']['articles'];
        }

        return $this->localApiService->getArticles();        
    }

    /**
     * Get a subset of articles filtered by a tag
     * 
     * @param string $tag The tag to filter the articles on
     */
    public function getArticlesByTag(string $tag)
    {
        if ($this->dataSource === 'api') {
            $articles = $this->apiService->get("thejournal/tag/${tag}");
            return $articles['response']['articles'];
        }

        return $this->localApiService->getArticlesByTag($tag);
    }
}
