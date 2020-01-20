<?php


namespace Tests\Integration\TheJournalIe\Data\Provider\Requester;

use GuzzleHttp\Client;
use JournalMedia\Sample\Integration\TheJournalIE\Data\Provider\Requester\ListArticles as ListArticlesRequester;
use Mockery;
use Tests\TestCase;

/**
 * Class ListArticlesTest responsible for the tests related to the class that makes the requests for the
 * API to get a list of articles.
 *
 * @package Tests\Integration\TheJournalIe\Provider\Requester
 *
 * @author Gabriel Anhaia <anhaia.gabriel@gmail.com>
 */
class ListArticlesTest extends TestCase
{
    /**
     * Test error trying to get a list of articles when the API returns a different HTTP status code.
     */
    public function testErrorGettingListOfArticlesHttpStatusCodeUnexpected()
    {
        $this->expectException(\Exception::class);
        $this->expectExceptionMessage('Request error.');

        $userName = 'TEST_USER_NAME_API';
        $password = 'TEST_PASSWORD_API';
        $baseUrl = 'TEST_BASE_URL';
        $publicationName = 'PUBLICATION_NAME_TEST_123';

        putenv("API_JOURNAL_USERNAME={$userName}");
        putenv("API_JOURNAL_PASSWORD={$password}");
        putenv("API_JOURNAL_BASE_URL={$baseUrl}");

        $guzzleClientMock = Mockery::mock(Client::class);
        $guzzleClientMock->expects('get')
            ->once()
            ->with("{$baseUrl}{$publicationName}", [
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

        $listArticlesRequester = new ListArticlesRequester($guzzleClientMock);
        $listArticlesRequester->listArticles($publicationName);
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
        $publicationName = 'PUBLICATION_NAME_TEST_123';

        $expectedResponse = '{RESPONSE_TEST}';

        putenv("API_JOURNAL_USERNAME={$userName}");
        putenv("API_JOURNAL_PASSWORD={$password}");
        putenv("API_JOURNAL_BASE_URL={$baseUrl}");

        $guzzleClientMock = Mockery::mock(Client::class);
        $guzzleClientMock->expects('get')
            ->once()
            ->with("{$baseUrl}{$publicationName}", [
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

        $listArticlesRequester = new ListArticlesRequester($guzzleClientMock);
        $response = $listArticlesRequester->listArticles($publicationName);

        $this->assertEquals($expectedResponse, $response);
    }
}