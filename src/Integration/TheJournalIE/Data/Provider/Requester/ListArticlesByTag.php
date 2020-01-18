<?php

namespace JournalMedia\Sample\Integration\TheJournalIE\Data\Provider\Requester;

use JournalMedia\Sample\Integration\TheJournalIE\{
    Data\Contract\IListArticlesByTag,
    Entity\ArticleEntity
};
use GuzzleHttp\Client as GuzzleClient;

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
     * @param string $tagName
     * @return ArticleEntity[]
     */
    public function listArticlesByTag(string $tagName): string
    {
        $result = [];

        $rawResult = $this->guzzleClient->get("https://api.thejournal.ie/v3/sample/tag/{$tagName}",[
            'auth' => [
                'codetest',
                'AQJl5jewY2lZkrJpiT1cCJkj1tLPn64R'
            ]
        ]);

        // TODO: Create enum for http status code
        if ($rawResult->getStatusCode() !== 200) {
            // TODO: Log it.
            return $result;
        }

        return $rawResult->getBody()
            ->getContents();    }
}