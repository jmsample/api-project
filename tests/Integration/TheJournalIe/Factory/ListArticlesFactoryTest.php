<?php


namespace Tests\Integration\TheJournalIe\Factory;


use GuzzleHttp\Client;
use JournalMedia\Sample\Integration\TheJournalIE\Data\Factory\ListArticlesFactory;
use JournalMedia\Sample\Integration\TheJournalIE\Data\Factory\Type\AbstractTypeEnum;
use JournalMedia\Sample\Integration\TheJournalIE\Data\Provider\{
    Cache\ListArticles as ListArticlesCache,
    Mock\ListArticles as ListArticlesMock,
    Requester\ListArticles as ListArticlesRequester
};
use Tests\TestCase;

/**
 * Class ListArticlesFactoryTest
 * @package Tests\Integration\TheJournalIe\Factory
 *
 * @author Gabriel Anhaia <anhaia.gabriel@gmail.com>
 */
class ListArticlesFactoryTest extends TestCase
{
    /**
     * Method responsible for testing the the cache factory.
     */
    public function testCreateListArticlesCache()
    {
        $abstractTypeEnumCache = AbstractTypeEnum::CACHE();

        $listArticlesFactory = new ListArticlesFactory;
        $listArticlesCache = $listArticlesFactory->make($abstractTypeEnumCache);

        $this->assertEquals(new ListArticlesCache, $listArticlesCache);
    }

    /**
     * Method responsible for testing the the mock factory.
     */
    public function testCreateListArticlesMock()
    {
        $abstractTypeEnumMock = AbstractTypeEnum::MOCK();

        $listArticlesFactory = new ListArticlesFactory;
        $listArticlesMock = $listArticlesFactory->make($abstractTypeEnumMock);

        $this->assertEquals(new ListArticlesMock, $listArticlesMock);
    }

    /**
     * Method responsible for testing the the requester factory.
     */
    public function testCreateListArticlesRequester()
    {
        $guzzleClient = new Client;
        $abstractTypeEnumRequester = AbstractTypeEnum::REQUESTER();

        $listArticlesFactory = new ListArticlesFactory($guzzleClient);
        $listArticlesRequester = $listArticlesFactory->make($abstractTypeEnumRequester);

        $this->assertEquals(new ListArticlesRequester($guzzleClient), $listArticlesRequester);
    }
}