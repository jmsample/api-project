<?php

namespace JournalMedia\Sample\Integration\TheJournalIE\Data\Provider\Mock;

use JournalMedia\Sample\Integration\TheJournalIE\Data\Contract\IListArticlesByTag;
use JournalMedia\Sample\Integration\TheJournalIE\Entity\ArticleEntity;

/**
 * Class ListArticlesByTag
 * @package JournalMedia\Sample\Integration\TheJournalIE\Data\Provider\Mock
 *
 * @author Gabriel Anhaia <anhaia.gabriel@gmail.com>
 */
class ListArticlesByTag implements IListArticlesByTag
{
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
            . 'thejournal.json';

        return $filePath;
    }

    /**
     * @param string $tagName
     * @return ArticleEntity[]
     */
    public function listArticlesByTag(string $tagName): string
    {
        $filePath = $this->getFilePath();

        // TODO: It would be interesting implement a File reader class (to be able to apply unit tests.)
        $rawResult = file_get_contents($filePath);

        return $rawResult;
    }
}