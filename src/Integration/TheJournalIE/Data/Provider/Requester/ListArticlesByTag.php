<?php

namespace JournalMedia\Sample\Integration\TheJournalIE\Data\Provider\Requester;

use JournalMedia\Sample\Integration\TheJournalIE\{
    Data\Contract\IListArticlesByTag,
    Entity\ArticleEntity
};
use GuzzleHttp\Client as GuzzleClient;

/**
 * Class ListArticlesByTag responsible for searching the list of articles at the API by tag name.
 *
 * @package JournalMedia\Sample\Integration\TheJournalIE\Data\Provider\Requester
 *
 * @author Gabriel Anhaia <anhaia.gabriel@gmail.com>
 */
class ListArticlesByTag implements IListArticlesByTag
{
    /** @var GuzzleClient $guzzleClient */
    private $guzzleClient;

    /**
     * ListArticlesByTag constructor.
     * @param GuzzleClient $guzzleClient
     */
    public function __construct(GuzzleClient $guzzleClient)
    {
        $this->guzzleClient = $guzzleClient;
    }

    /**
     * List articles by tag name.
     *
     * @param string $tagName
     * @return ArticleEntity[]
     * @throws \Exception
     */
    public function listArticlesByTag(string $tagName): string
    {
        $userName = getenv('API_JOURNAL_USERNAME');
        $password = getenv('API_JOURNAL_PASSWORD');
        $baseUrl = getenv('API_JOURNAL_BASE_URL');

        $rawResult = $this->guzzleClient->get("{$baseUrl}tag/{$tagName}",[
            'auth' => [
                $userName,
                $password
            ]
        ]);

        // TODO: Create enum for http status code
        if ($rawResult->getStatusCode() !== 200) {
            throw new \Exception('Request error.');
        }

        return $rawResult->getBody()
            ->getContents();    }
}