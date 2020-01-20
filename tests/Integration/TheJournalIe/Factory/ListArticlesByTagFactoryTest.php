<?php


namespace Tests\Integration\TheJournalIe\Factory;

use GuzzleHttp\Client;
use JournalMedia\Sample\Integration\TheJournalIE\Data\Factory\ListArticlesByTagFactory;
use JournalMedia\Sample\Integration\TheJournalIE\Data\Factory\Type\AbstractTypeEnum;
use JournalMedia\Sample\Integration\TheJournalIE\Data\Provider\{
    Cache\ListArticlesByTag as ListArticlesByTagCache,
    Mock\ListArticlesByTag as ListArticlesByTagMock,
    Requester\ListArticlesByTag as ListArticlesByTagRequester
};
use Tests\TestCase;

/**
 * Class ListArticlesByTagFactoryTest
 * @package Tests\Integration\TheJournalIe\Factory
 *
 * @author Gabriel Anhaia <anhaia.gabriel@gmail.com>
 */
class ListArticlesByTagFactoryTest extends TestCase
{
    /**
     * Method responsible for testing the the cache factory.
     */
    public function testCreateListArticlesByTagCache()
    {
        $abstractTypeEnumCache = AbstractTypeEnum::CACHE();

        $listArticlesByTagFactory = new ListArticlesByTagFactory;
        $listArticlesByTagCache = $listArticlesByTagFactory->make($abstractTypeEnumCache);

        $this->assertEquals(new ListArticlesByTagCache, $listArticlesByTagCache);
    }

    /**
     * Method responsible for testing the the mock factory.
     */
    public function testCreateListArticlesByTagMock()
    {
        $abstractTypeEnumMock = AbstractTypeEnum::MOCK();

        $listArticlesByTagFactory = new ListArticlesByTagFactory;
        $listArticlesByTagMock = $listArticlesByTagFactory->make($abstractTypeEnumMock);

        $this->assertEquals(new ListArticlesByTagMock, $listArticlesByTagMock);
    }

    /**
     * Method responsible for testing the the requester factory.
     */
    public function testCreateListArticlesByTagRequester()
    {
        $guzzleClient = new Client;
        $abstractTypeEnumRequester = AbstractTypeEnum::REQUESTER();

        $listArticlesByTagFactory = new ListArticlesByTagFactory($guzzleClient);
        $listArticlesByTagRequester = $listArticlesByTagFactory->make($abstractTypeEnumRequester);

        $this->assertEquals(new ListArticlesByTagRequester($guzzleClient), $listArticlesByTagRequester);
    }
}