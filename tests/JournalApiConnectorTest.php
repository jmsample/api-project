<?php
declare(strict_types=1);

use GuzzleHttp\Client;
use JournalMedia\Sample\ApiProject\ApiException;
use JournalMedia\Sample\ApiProject\Connector\JournalApiConnector;
use PHPUnit\Framework\TestCase;

class JournalApiConnectorTest extends TestCase
{
    const BASE_URL = 'http://base-api_url';
    const RELATIVE_URL = 'test';
    const JSON_RESPONSE = '{"status":true, "response": {"articles": []}}';
    const USERNAME = 'username';
    const PASSWORD = 'password';
    /** @test */
    public function it_creates_get_request_with_authorization_headers()
    {
        $client = new Client([
            'handler' => function (GuzzleHttp\Psr7\Request $request) {
                $this->assertEquals(
                    ['Basic ' . base64_encode(self::USERNAME . ':' . self::PASSWORD)],
                    $request->getHeader('Authorization')
                );
                $this->assertEquals(self::BASE_URL . '/' . self::RELATIVE_URL, $request->getUri());
                return new GuzzleHttp\Psr7\Response(200, [], self::JSON_RESPONSE);
            }
        ]);
        $journalApiConnector = new JournalApiConnector(self::BASE_URL, $client);
        $journalApiConnector->setUsername(self::USERNAME)->setPassword(self::PASSWORD);
        $journalApiConnector->doGet('/' . self::RELATIVE_URL);
    }

    /** @test */
    public function it_creates_get_request_without_authorization_headers()
    {
        $client = new Client([
            'handler' => function (GuzzleHttp\Psr7\Request $request) {
                $this->assertEquals(
                    [],
                    $request->getHeader('Authorization')
                );
                $this->assertEquals(self::BASE_URL . '/' . self::RELATIVE_URL, $request->getUri());
                return new GuzzleHttp\Psr7\Response(200, [], self::JSON_RESPONSE);
            }
        ]);
        $journalApiConnector = new JournalApiConnector(self::BASE_URL, $client);
        $journalApiConnector->doGet('/' . self::RELATIVE_URL);
    }

    /** @test */
    public function it_creates_post_request_with_authorization_headers()
    {
        $client = new Client([
            'handler' => function (GuzzleHttp\Psr7\Request $request) {
                $this->assertEquals(
                    ['Basic ' . base64_encode(self::USERNAME . ':' . self::PASSWORD)],
                    $request->getHeader('Authorization')
                );
                $this->assertEquals(self::BASE_URL . '/' . self::RELATIVE_URL, $request->getUri());
                return new GuzzleHttp\Psr7\Response(200, [], self::JSON_RESPONSE);
            }
        ]);
        $journalApiConnector = new JournalApiConnector(self::BASE_URL, $client);
        $journalApiConnector->setUsername(self::USERNAME)->setPassword(self::PASSWORD);
        $journalApiConnector->doPost('/' . self::RELATIVE_URL);
    }

    /** @test */
    public function it_creates_request_with_custom_headers()
    {
        $client = new Client([
            'handler' => function (GuzzleHttp\Psr7\Request $request) {
                $this->assertEquals(
                    ['customValue'],
                    $request->getHeader('customHeader')
                );
                $this->assertEquals(self::BASE_URL . '/' . self::RELATIVE_URL, $request->getUri());
                return new GuzzleHttp\Psr7\Response(200, [], self::JSON_RESPONSE);
            }
        ]);
        $journalApiConnector = new JournalApiConnector(self::BASE_URL, $client);
        $journalApiConnector->doGet('/' . self::RELATIVE_URL, ['customHeader' => 'customValue']);
    }

    /** @test */
    public function it_throws_api_exception_when_bad_response()
    {
        $this->expectException(ApiException::class);

        $client = new Client([
            'handler' => function (GuzzleHttp\Psr7\Request $request) {
                $this->assertEquals(self::BASE_URL . '/' . self::RELATIVE_URL, $request->getUri());
                return new GuzzleHttp\Psr7\Response(200, [], '');
            }
        ]);
        $journalApiConnector = new JournalApiConnector(self::BASE_URL, $client);
        $journalApiConnector->doGet('/' . self::RELATIVE_URL, ['customHeader' => 'customValue']);
    }

    /** @test */
    public function it_creates_get_request_with_query_parameters()
    {
        $client = new Client([
            'handler' => function (GuzzleHttp\Psr7\Request $request) {
                $this->assertEquals(self::BASE_URL . '/' . self::RELATIVE_URL . '?param1=1&param2=2', $request->getUri());
                return new GuzzleHttp\Psr7\Response(200, [], self::JSON_RESPONSE);
            }
        ]);
        $journalApiConnector = new JournalApiConnector(self::BASE_URL, $client);
        $journalApiConnector->doGet('/' . self::RELATIVE_URL, [], ['param1' => '1', 'param2' => '2']);
    }

    /** @test */
    public function it_creates_post_request_with_data()
    {
        $client = new Client([
            'handler' => function (GuzzleHttp\Psr7\Request $request) {
                $this->assertEquals('{"param1":"1","param2":"2"}', $request->getBody()->getContents());
                return new GuzzleHttp\Psr7\Response(200, [], self::JSON_RESPONSE);
            }
        ]);
        $journalApiConnector = new JournalApiConnector(self::BASE_URL, $client);
        $journalApiConnector->doPost('/' . self::RELATIVE_URL, [], ['param1' => '1', 'param2' => '2']);
    }

    /** @test */
    public function it_creates_get_method()
    {
        $client = new Client([
            'handler' => function (GuzzleHttp\Psr7\Request $request) {
                $this->assertEquals('GET', $request->getMethod());
                return new GuzzleHttp\Psr7\Response(200, [], self::JSON_RESPONSE);
            }
        ]);
        $journalApiConnector = new JournalApiConnector(self::BASE_URL, $client);
        $journalApiConnector->doGet('/' . self::RELATIVE_URL);
    }

    /** @test */
    public function it_creates_post_method()
    {
        $client = new Client([
            'handler' => function (GuzzleHttp\Psr7\Request $request) {
                $this->assertEquals('POST', $request->getMethod());
                return new GuzzleHttp\Psr7\Response(200, [], self::JSON_RESPONSE);
            }
        ]);
        $journalApiConnector = new JournalApiConnector(self::BASE_URL, $client);
        $journalApiConnector->doPost('/' . self::RELATIVE_URL);
    }
}