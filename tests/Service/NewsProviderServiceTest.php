<?php

namespace App\Tests\Service;

use JournalMedia\Sample\ApiProject\Service\StaticContentProviderService;
use JournalMedia\Sample\ApiProject\Transformer\HtmlTransformer;
use PHPUnit\Framework\TestCase;
use JournalMedia\Sample\ApiProject\Service\NewsProviderService;
use Symfony\Component\HttpClient\MockHttpClient;
use Symfony\Component\HttpClient\Response\MockResponse;

class NewsProviderServiceTest extends TestCase
{
    protected function setUp() : void
    {
        $_ENV['API_URL'] = 'https://someurl.com';
        $_ENV['API_USER'] = 'user';
        $_ENV['API_PASSWD'] = 'password';
    }

    public function testGetDemoRiverTagNotAllowed() : void
    {
        $mockResponse = new MockResponse([], [
            'http_code' => 200,
            'response_headers' => ['Content-Type: application/json'],
        ]);

        $_ENV['DEMO_MODE'] = 'true';
        $tag = "XSDSS";
        $httpClient = new MockHttpClient($mockResponse, 'https://foo.com');
        $service = new NewsProviderService($httpClient, new StaticContentProviderService(), new HtmlTransformer());
        $result = $service->getNewsContent($tag);
        $this->assertEquals('Tag not allowed', $result);
    }

    public function testGetDemoOffRiverNews() : void
    {
        $_ENV['DEMO_MODE'] = 'false';
        $mockResponseJson = file_get_contents(__DIR__ . '/fixtures/thejournal.json');
        $mockResponse = new MockResponse($mockResponseJson, [
            'http_code' => 200,
            'response_headers' => ['Content-Type: application/json'],
        ]);


        $httpClient = new MockHttpClient($mockResponse, $_ENV['API_URL'], [
            'auth_basic' => [
                $_ENV['API_USER'],
                $_ENV['API_PASSWD']
            ]
        ]);

        $service = new NewsProviderService($httpClient, new StaticContentProviderService(), new HtmlTransformer());
        $result = $service->getNewsContent();

        $expected = '<table><tr><td>Type:post</td></tr>';
        $expected .= '<tr><td>Title:MAIN TITLE</td></tr>';
        $expected .='<tr><td>Excerpt:EXCERPT</td></tr>';
        $expected .='<tr><td>Image Medium:<img src="https://medium.jpg"></td></tr>';
        $expected .='<tr><td>Image Large:<img src="https://large.jpg"></td></tr></table>';
        $expected = preg_replace('/\s+/', ' ', trim($expected));
        $this->assertEquals($expected, $result);
    }
}