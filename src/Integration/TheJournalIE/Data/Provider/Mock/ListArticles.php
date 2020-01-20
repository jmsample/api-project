<?php

namespace JournalMedia\Sample\Integration\TheJournalIE\Data\Provider\Mock;

use JournalMedia\Sample\Integration\TheJournalIE\{Data\Contract\IListArticles, Entity\ArticleEntity};

/**
 * Class ListArticles
 * @package JournalMedia\Sample\Integration\TheJournalIE\Data\Provider\Mock
 *
 * @author Gabriel Anhaia <anhaia.gabriel@gmail.com>
 */
class ListArticles implements IListArticles
{
    /**
     * @param string $publicationName
     * @return ArticleEntity[]
     */
    public function listArticles(string $publicationName): string
    {
        $filePath = $this->getFilePath();

        // TODO: It would be interesting implement a File reader class (to be able to apply unit tests.)
        $rawResult = file_get_contents($filePath);

        return $rawResult;
    }

    /**
     * @return string
     */
    private function getFilePath(): string
    {
        $filePath = $_SERVER['DOCUMENT_ROOT']
            . DIRECTORY_SEPARATOR
            . '..'
            . DIRECTORY_SEPARATOR
            . 'resources'
            . DIRECTORY_SEPARATOR
            . 'demo-responses'
            . DIRECTORY_SEPARATOR
            . 'google.json';

        return $filePath;
    }
}