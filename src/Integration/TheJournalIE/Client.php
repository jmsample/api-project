<?php


namespace JournalMedia\Sample\Integration\TheJournalIE;

use JournalMedia\Sample\Integration\{TheJournalIE\Data\Factory\GeneralFactory,
    TheJournalIE\Data\Factory\Type\AbstractFactoryEnum,
    TheJournalIE\Data\Factory\Type\AbstractTypeEnum,
    TheJournalIE\Entity\ArticleEntity,
    TheJournalIE\Parser\ArticleParser
};

/**
 * Class Client
 * @package JournalMedia\Sample\Integration\TheJournalIE
 *
 * @author Gabriel Anhaia <anhaia.gabriel@gmail.com>
 */
class Client
{
    /** @var AbstractTypeEnum $dataProviderType */
    private $dataProviderType;

    /** @var GeneralFactory $generalFactory */
    private $generalFactory;

    /**
     * Client constructor.
     */
    public function __construct()
    {
        $this->defineDefaultDataProvider();
        $this->generalFactory = new GeneralFactory;
    }

    /**
     * Return the data provider following the configuration (ENV).
     *
     * One idea is maybe in the future change and allow more data providers.
     *
     * @return mixed
     */
    private function defineDefaultDataProvider()
    {
        if (getenv('DEMO_MODE') === 'true') {
            $this->dataProviderType = AbstractTypeEnum::MOCK();
        } else {
            $this->dataProviderType = AbstractTypeEnum::REQUESTER();
        }
    }

    /**
     * Return the default data provider.
     *
     * @return AbstractTypeEnum
     */
    public function getDataProviderType(): AbstractTypeEnum
    {
        return $this->dataProviderType;
    }

    /**
     * List all articles available.
     * @param string $publicationName
     * @return array
     * @throws \Exception
     */
    public function listArticles(string $publicationName): array
    {
        $factory = $this->generalFactory->makeFactory(AbstractFactoryEnum::LIST_ARTICLES());
        $dataProvider = $factory->make($this->dataProviderType);
        $rawResult = $dataProvider->listArticles($publicationName);
        $parser = new ArticleParser;

        return $parser->parse($rawResult);
    }

    /**
     * List all articles by tag name.
     *
     * @param string $tagName Name of the tag to search for articles.
     * @return ArticleEntity[]
     * @throws \Exception
     */
    public function listArticlesByTagName(string $tagName): array
    {
        $factory = $this->generalFactory->makeFactory(AbstractFactoryEnum::LIST_ARTICLES_BY_TAG());
        $dataProvider = $factory->make($this->dataProviderType);
        $rawResult = $dataProvider->listArticlesByTag($tagName);
        $parser = new ArticleParser;

        return $parser->parse($rawResult);
    }
}