<?php


namespace JournalMedia\Sample\Integration\TheJournalIE\Data\Factory;

use JournalMedia\Sample\Integration\TheJournalIE\Data\Contract\IListArticles;
use JournalMedia\Sample\Integration\TheJournalIE\Data\Contract\IListArticlesByTag;
use JournalMedia\Sample\Integration\TheJournalIE\Data\Factory\Type\AbstractTypeEnum;

/**
 * Interface AbstractDataProviderFactory
 * @package JournalMedia\Sample\Integration\TheJournalIE\Data\Factory
 */
interface AbstractDataProviderFactory
{
    public function make(AbstractTypeEnum $type);
}