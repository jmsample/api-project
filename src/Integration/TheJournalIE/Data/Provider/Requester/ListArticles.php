<?php

namespace JournalMedia\Sample\Integration\TheJournalIE\Data\Provider\Requester;

use JournalMedia\Sample\Integration\TheJournalIE\Data\Contract\IListArticles;
use JournalMedia\Sample\Integration\TheJournalIE\Entity\ArticleEntity;

/**
 * Class ListArticles responsible for request a list of articles.
 *
 * @package JournalMedia\Sample\Integration\TheJournalIE\Data\Provider\Requester
 *
 * @author Gabriel Anhaia <anhaia.gabriel@gmail.com>
 */
class ListArticles extends AbstractRequester implements IListArticles
{
    /**
     * @param string $publicationName
     * @return ArticleEntity[]
     */
    public function listArticles(string $publicationName): string
    {
        $result = [];

        $rawResult = $this->guzzleClient->get("https://api.thejournal.ie/v3/sample/{$publicationName}",[
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
            ->getContents();
    }
}