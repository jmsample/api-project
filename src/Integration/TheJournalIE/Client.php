<?php


namespace JournalMedia\Sample\Integration\TheJournalIE;

use JournalMedia\Sample\Integration\{TheJournalIE\Data\Factory\GeneralFactory,
    TheJournalIE\Data\Factory\Type\AbstractFactoryEnum,
    TheJournalIE\Data\Factory\Type\AbstractTypeEnum,
    TheJournalIE\Entity\ArticleEntity,
    TheJournalIE\Parser\ArticleParser,
    TheJournalIE\Parser\Factory\ParserFactory,
    TheJournalIE\Parser\Factory\ParserTypeEnum};

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

    /** @var ParserFactory $parserFactory */
    private $parserFactory;

    /**
     * Client constructor.
     * @param GeneralFactory|null $generalFactory
     * @param ParserFactory $parserFactory
     */
    public function __construct(GeneralFactory $generalFactory = null, ParserFactory $parserFactory = null)
    {
        $this->defineDefaultDataProvider();
        $this->generalFactory = $generalFactory ?? (new GeneralFactory);
        $this->parserFactory = $parserFactory ?? (new ParserFactory);
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
        if (getenv('DEMO_MODE') === 'true' || getenv('DEMO_MODE') === "1") {
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
        $parser = $this->parserFactory->make(ParserTypeEnum::PARSER_ARTICLES());

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
        $parser = $this->parserFactory->make(ParserTypeEnum::PARSER_ARTICLES());

        return $parser->parse($rawResult);
    }
}