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
     * Method responsible for the request to the Journal API to get a list of articles.
     *
     * @param string $publicationName Name of the publication to be searched.
     * @return ArticleEntity[]
     * @throws \Exception
     */
    public function listArticles(string $publicationName): string
    {
        $userName = getenv('API_JOURNAL_USERNAME');
        $password = getenv('API_JOURNAL_PASSWORD');
        $baseUrl = getenv('API_JOURNAL_BASE_URL');

        $rawResult = $this->guzzleClient->get("{$baseUrl}{$publicationName}",[
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
            ->getContents();
    }
}