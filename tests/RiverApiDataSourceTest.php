<?php
declare(strict_types=1);

use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use JournalMedia\Sample\ApiProject\Connector\JournalApiConnector;
use JournalMedia\Sample\ApiProject\Service\RiverApiDataSource;
use PHPUnit\Framework\TestCase;

class RiverApiDataSourceTest extends TestCase
{
    const PUBLICATION_NAME = 'thejournal';
    const TAG_NAME = 'google';
    const BASE_URL = 'http://base-api_url';
    const USERNAME = 'username';

    const PASSWORD = 'password';

    /** @test
     * @throws GuzzleException
     */
    public function it_get_publication_articles()
    {
        $client = new Client([
            'handler' => function (GuzzleHttp\Psr7\Request $request) {
                $this->assertEquals(self::BASE_URL . '/' . self::PUBLICATION_NAME, $request->getUri());
                return new GuzzleHttp\Psr7\Response(200, [], $this->getPublicationResponse());
            }
        ]);
        $journalApiConnector = new JournalApiConnector(self::BASE_URL, $client);
        $journalApiConnector->setUsername(self::USERNAME)->setPassword(self::PASSWORD);
        $dataSource = new RiverApiDataSource($journalApiConnector);
        $articles = $dataSource->getArticlesByPublication(self::PUBLICATION_NAME);
        $article = reset($articles);
        $this->assertArticleFields($article);
    }

    /** @test
     * @throws GuzzleException
     */
    public function it_get_tag_articles()
    {
        $client = new Client([
            'handler' => function (GuzzleHttp\Psr7\Request $request) {
                $this->assertEquals(self::BASE_URL . '/tag/' . self::TAG_NAME, $request->getUri());
                return new GuzzleHttp\Psr7\Response(200, [], $this->getTagResponse());
            }
        ]);
        $journalApiConnector = new JournalApiConnector(self::BASE_URL, $client);
        $journalApiConnector->setUsername(self::USERNAME)->setPassword(self::PASSWORD);
        $dataSource = new RiverApiDataSource($journalApiConnector);
        $articles = $dataSource->getArticlesByTag(self::TAG_NAME);
        $article = reset($articles);
        $this->assertArticleFields($article);
    }

    /**
     * @param mixed $article
     * @return void
     */
    private function assertArticleFields(mixed $article): void
    {
        $this->assertNotEmpty($article['title']);
        $this->assertNotEmpty($article['excerpt']);
        $this->assertNotEmpty($article['images']);
    }

    /**
     * @return string
     */
    private function getPublicationResponse(): string
    {
        return file_get_contents(__DIR__ . DIRECTORY_SEPARATOR . 'responses/thejournal');

    }
    private function getTagResponse(): string
    {
        return file_get_contents(__DIR__ . DIRECTORY_SEPARATOR . 'responses/google');
    }
}