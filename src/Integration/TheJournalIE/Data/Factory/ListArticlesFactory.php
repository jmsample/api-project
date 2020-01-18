<?php


namespace JournalMedia\Sample\Integration\TheJournalIE\Data\Factory;

use GuzzleHttp\Client;
use JournalMedia\Sample\Integration\TheJournalIE\Data\Contract\IListArticles;
use JournalMedia\Sample\Integration\TheJournalIE\Data\Factory\Type\AbstractTypeEnum;
use JournalMedia\Sample\Integration\TheJournalIE\Data\Provider\{
    Cache\ListArticles as ListArticlesCache,
    Mock\ListArticles as ListArticlesMock,
    Requester\ListArticles as ListArticlesRequester
};

/**
 * Class ListArticlesFactory
 * @package JournalMedia\Sample\Integration\TheJournalIE\Data\Factory
 */
class ListArticlesFactory implements AbstractDataProviderFactory
{
    public function make(AbstractTypeEnum $type): IListArticles
    {
        switch ($type->value()) {
            case AbstractTypeEnum::CACHE:
                return new ListArticlesCache;
                break;
            case AbstractTypeEnum::MOCK:
                return new ListArticlesMock;
                break;
            case AbstractTypeEnum::REQUESTER:
                return new ListArticlesRequester(new Client);
                break;
        }
    }
}