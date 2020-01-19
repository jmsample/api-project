<?php


namespace Tests\Integration\TheJournalIe;

use JournalMedia\Sample\Integration\TheJournalIE\Client;
use JournalMedia\Sample\Integration\TheJournalIE\Data\Factory\GeneralFactory;
use JournalMedia\Sample\Integration\TheJournalIE\Data\Factory\ListArticlesByTagFactory;
use JournalMedia\Sample\Integration\TheJournalIE\Data\Factory\ListArticlesFactory;
use JournalMedia\Sample\Integration\TheJournalIE\Data\Factory\Type\AbstractFactoryEnum;
use JournalMedia\Sample\Integration\TheJournalIE\Data\Factory\Type\AbstractTypeEnum;
use JournalMedia\Sample\Integration\TheJournalIE\Data\Provider\Mock\ListArticles;
use JournalMedia\Sample\Integration\TheJournalIE\Data\Provider\Mock\ListArticlesByTag;
use JournalMedia\Sample\Integration\TheJournalIE\Parser\ArticleParser;
use JournalMedia\Sample\Integration\TheJournalIE\Parser\Factory\ParserFactory;
use JournalMedia\Sample\Integration\TheJournalIE\Parser\Factory\ParserTypeEnum;
use Mockery\Mock;
use Tests\TestCase;

/**
 * Class ClientTest responsible for testing the Client for the integration with The Journal.ie API.
 * @package Tests\Integration\TheJournalIe
 *
 * @author Gabriel Anhaia <anhaia.gabriel@gmail.com>
 */
class ClientTest extends TestCase
{
    /**
     * Test if the test environment is running and creating a new instance with
     * the mock data provider.
     */
    public function testSuccessTestEnvironmentUsingMockDataProvider()
    {
        $client = new Client;
        $this->assertEquals(AbstractTypeEnum::MOCK(), $client->getDataProviderType());
    }

    /**
     * Test method responsible for listing articles.
     */
    public function testSuccessMethodListArticles()
    {
        $publicationName = 'PUBLICATION_NAME';
        $rawDataResponse = "{RAW_RESPONSE_API}";
        $parsedData = ['PARSER' => 'DATA'];

        $parserArticleMock = \Mockery::mock(ArticleParser::class);
        $parserArticleMock->expects('parse')
            ->once()
            ->with($rawDataResponse)
            ->andReturn($parsedData);

        $parserFactoryMock = \Mockery::mock(ParserFactory::class);
        $parserFactoryMock->expects('make')
            ->once()
            ->with(ParserTypeEnum::PARSER_ARTICLES())
            ->andReturn($parserArticleMock);

        $listArticlesDataProviderMock = \Mockery::mock(ListArticles::class);
        $listArticlesDataProviderMock->expects('listArticles')
            ->once()
            ->with($publicationName)
            ->andReturn($rawDataResponse);

        $listArticlesFactoryMock = \Mockery::mock(ListArticlesFactory::class);
        $listArticlesFactoryMock->expects('make')
            ->once()
            ->with(AbstractTypeEnum::MOCK())
            ->andReturn($listArticlesDataProviderMock);

        $generalFactoryMock = \Mockery::mock(GeneralFactory::class);
        $generalFactoryMock->expects('makeFactory')
            ->once()
            ->with(AbstractFactoryEnum::LIST_ARTICLES())
            ->andReturn($listArticlesFactoryMock);

        $client = new Client($generalFactoryMock, $parserFactoryMock);
        $response = $client->listArticles($publicationName);

        $this->assertEquals($parsedData, $response);
    }

    /**
     * Test method responsible for listing articles by tag.
     */
    public function testSuccessMethodListArticlesByTag()
    {
        $tagName = 'PUBLICATION_NAME';
        $rawDataResponse = "{RAW_RESPONSE_API}";
        $parsedData = ['PARSER' => 'DATA'];

        $parserArticleMock = \Mockery::mock(ArticleParser::class);
        $parserArticleMock->expects('parse')
            ->once()
            ->with($rawDataResponse)
            ->andReturn($parsedData);

        $parserFactoryMock = \Mockery::mock(ParserFactory::class);
        $parserFactoryMock->expects('make')
            ->once()
            ->with(ParserTypeEnum::PARSER_ARTICLES())
            ->andReturn($parserArticleMock);

        $listArticlesDataProviderMock = \Mockery::mock(ListArticlesByTag::class);
        $listArticlesDataProviderMock->expects('listArticlesByTag')
            ->once()
            ->with($tagName)
            ->andReturn($rawDataResponse);

        $listArticlesFactoryMock = \Mockery::mock(ListArticlesByTagFactory::class);
        $listArticlesFactoryMock->expects('make')
            ->once()
            ->with(AbstractTypeEnum::MOCK())
            ->andReturn($listArticlesDataProviderMock);

        $generalFactoryMock = \Mockery::mock(GeneralFactory::class);
        $generalFactoryMock->expects('makeFactory')
            ->once()
            ->with(AbstractFactoryEnum::LIST_ARTICLES_BY_TAG())
            ->andReturn($listArticlesFactoryMock);

        $client = new Client($generalFactoryMock, $parserFactoryMock);
        $response = $client->listArticlesByTagName($tagName);

        $this->assertEquals($parsedData, $response);
    }
}