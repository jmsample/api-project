<?php


namespace JournalMedia\Sample\Integration\TheJournalIE\Data\Factory;

use JournalMedia\Sample\Integration\TheJournalIE\Data\Factory\Type\AbstractFactoryEnum;

/**
 * Class GeneralFactory
 * @package JournalMedia\Sample\Integration\TheJournalIE\Data\Factory
 */
class GeneralFactory
{
    /**
     * @param AbstractFactoryEnum $factoryType
     * @return AbstractDataProviderFactory
     * @throws \Exception
     */
    public function makeFactory(AbstractFactoryEnum $factoryType): AbstractDataProviderFactory
    {
        switch ($factoryType->value()) {
            case AbstractFactoryEnum::LIST_ARTICLES:
                return new ListArticlesFactory;
                break;
            case AbstractFactoryEnum::LIST_ARTICLES_BY_TAG:
                return new ListArticlesByTagFactory;
                break;
            default:
                throw new \Exception('Factory not implemented.');
        }
    }
}