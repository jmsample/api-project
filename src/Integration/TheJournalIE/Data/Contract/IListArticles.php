<?php


namespace JournalMedia\Sample\Integration\TheJournalIE\Data\Contract;

use JournalMedia\Sample\Integration\TheJournalIE\Entity\ArticleEntity;

interface IListArticles
{
    /**
     * @param string $publicationName
     * @return ArticleEntity[]
     */
    public function listArticles(string $publicationName): string;
}