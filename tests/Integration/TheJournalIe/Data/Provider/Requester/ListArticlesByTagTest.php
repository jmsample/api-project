<?php


namespace Tests\Integration\TheJournalIe\Data\Provider\Requester;

use GuzzleHttp\Client;
use JournalMedia\Sample\Integration\TheJournalIE\Data\Provider\Requester\ListArticlesByTag as ListArticlesByTagRequester;
use Mockery;
use Tests\TestCase;

/**
 * Class ListArticlesByTagTest responsible for the tests related to the class that makes the requests for the
 * API to get a list of articles by tag name.
 *
 * @package Tests\Integration\TheJournalIe\Provider\Requester
 *
 * @author Gabriel Anhaia <anhaia.gabriel@gmail.com>
 */
class ListArticlesByTagTest extends TestCase
{
    /**
     * Test error trying to get a list of articles when the API returns a different HTTP status code.
     */
    public function testErrorGettingListOfArticlesByTagHttpStatusCodeUnexpected()
    {
        $this->expectException(\Exception::class);
        $this->expectExceptionMessage('Request error.');

        $userName = 'TEST_USER_NAME_API';
        $password = 'TEST_PASSWORD_API';
        $baseUrl = 'TEST_BASE_URL';
        $tagName = 'TAG_NAME_TEST_123';

        putenv("API_JOURNAL_USERNAME={$userName}");
        putenv("API_JOURNAL_PASSWORD={$password}");
        putenv("API_JOURNAL_BASE_URL={$baseUrl}");

        $guzzleClientMock = Mockery::mock(Client::class);
        $guzzleClientMock->expects('get')
            ->once()
            ->with("{$baseUrl}tag/{$tagName}", [
                'auth' => [
                    $userName,
                    $password
                ]
            ])
            ->andReturnSelf();

        $guzzleClientMock->expects('getStatusCode')
            ->once()
            ->withNoArgs()
            ->andReturn(400);

        $listArticlesRequester = new ListArticlesByTagRequester($guzzleClientMock);
        $listArticlesRequester->listArticlesByTag($tagName);
    }

    /**
     * Test success listing articles (by API).
     *
     * @throws \Exception
     */
    public function testSuccessGettingListOfArticles()
    {
        $userName = 'TEST_USER_NAME_API';
        $password = 'TEST_PASSWORD_API';
        $baseUrl = 'TEST_BASE_URL';
        $tagName = 'TAG_NAME_TEST_123';

        putenv("API_JOURNAL_USERNAME={$userName}");
        putenv("API_JOURNAL_PASSWORD={$password}");
        putenv("API_JOURNAL_BASE_URL={$baseUrl}");

        $expectedResponse = '{EXPECTED_RESPONSE}';

        $guzzleClientMock = Mockery::mock(Client::class);
        $guzzleClientMock->expects('get')
            ->once()
            ->with("{$baseUrl}tag/{$tagName}", [
                'auth' => [
                    $userName,
                    $password
                ]
            ])
            ->andReturnSelf();

        $guzzleClientMock->expects('getStatusCode')
            ->once()
            ->withNoArgs()
            ->andReturn(200);

        $guzzleClientMock->expects('getBody')
            ->once()
            ->withNoArgs()
            ->andReturnSelf();

        $guzzleClientMock->expects('getContents')
            ->once()
            ->withNoArgs()
            ->andReturn($expectedResponse);

        $listArticlesRequester = new ListArticlesByTagRequester($guzzleClientMock);
        $expectedResponse = $listArticlesRequester->listArticlesByTag($tagName);

        $this->assertEquals($expectedResponse, $expectedResponse);
    }
}