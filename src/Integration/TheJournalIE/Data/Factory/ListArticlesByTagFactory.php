<?php


namespace JournalMedia\Sample\Integration\TheJournalIE\Data\Factory;


use GuzzleHttp\Client;
use JournalMedia\Sample\Integration\TheJournalIE\Data\Contract\IListArticlesByTag;
use JournalMedia\Sample\Integration\TheJournalIE\Data\Factory\Type\AbstractTypeEnum;
use JournalMedia\Sample\Integration\TheJournalIE\Data\Provider\Cache\ListArticlesByTag as ListArticlesAliasCacheByTag;
use JournalMedia\Sample\Integration\TheJournalIE\Data\Provider\Mock\ListArticlesByTag as ListArticlesMockByTag;
use JournalMedia\Sample\Integration\TheJournalIE\Data\Provider\Requester\ListArticlesByTag as ListArticlesRequesterByTag;

/**
 * Class ListArticlesByTagFactory
 * @package JournalMedia\Sample\Integration\TheJournalIE\Data\Factory
 *
 * @author Gabriel Anhaia <anhaia.gabriel@gmail.com>
 */
class ListArticlesByTagFactory implements AbstractDataProviderFactory
{
    public function make(AbstractTypeEnum $type): IListArticlesByTag
    {
        switch ($type->value()) {
            case AbstractTypeEnum::CACHE:
                return new ListArticlesAliasCacheByTag;
                break;
            case AbstractTypeEnum::MOCK:
                return new ListArticlesMockByTag;
                break;
            case AbstractTypeEnum::REQUESTER:
                return new ListArticlesRequesterByTag(new Client);
                break;
        }
    }
}