<?php

namespace JournalMedia\Sample\Integration\TheJournalIE\Data\Provider\Cache;

use JournalMedia\Sample\Integration\TheJournalIE\Data\Contract\IListArticlesByTag;
use JournalMedia\Sample\Integration\TheJournalIE\Entity\ArticleEntity;

class ListArticlesByTag implements IListArticlesByTag
{
    /**
     * @param string $tagName
     * @return ArticleEntity[]
     */
    public function listArticlesByTag(string $tagName): string
    {
        dd('Implement it.');
    }
}