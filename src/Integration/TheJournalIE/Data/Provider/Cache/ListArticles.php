<?php

namespace JournalMedia\Sample\Integration\TheJournalIE\Data\Provider\Cache;

use JournalMedia\Sample\Integration\TheJournalIE\Data\Contract\IListArticles;
use JournalMedia\Sample\Integration\TheJournalIE\Entity\ArticleEntity;

class ListArticles implements IListArticles
{
    /**
     * @param string $publicationName
     * @return ArticleEntity[]
     */
    public function listArticles(string $publicationName): string
    {
        dd('Implement it.');
    }
}