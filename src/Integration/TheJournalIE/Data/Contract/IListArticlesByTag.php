<?php


namespace JournalMedia\Sample\Integration\TheJournalIE\Data\Contract;

use JournalMedia\Sample\Integration\TheJournalIE\Entity\ArticleEntity;

interface IListArticlesByTag
{
    /**
     * @param string $tagName
     * @return ArticleEntity[]
     */
    public function listArticlesByTag(string $tagName): string;
}