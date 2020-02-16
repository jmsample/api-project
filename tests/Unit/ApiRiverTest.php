<?php

namespace Unit;

use JournalMedia\Sample\Repository\ApiRiverRepository;
use JournalMedia\Sample\Helpers\ApiHelper;

use PHPUnit\Framework\TestCase;

class ApiRiverTest extends TestCase
{
    public function setUp()
    {
        $this->url = 'https://api.thejournal.ie/v3/sample/thejournal/';
        $this->userName = 'codetest';
        $this->pass = 'AQJl5jewY2lZkrJpiT1cCJkj1tLPn64R';
        $this->riverApi = new ApiRiverRepository($this->url, $this->userName, $this->pass);
    }

    public function testMakeApiCall()
    {
        $response = ApiHelper::makeApiCall($this->url, $this->userName, $this->pass);
        $this->assertEquals(200, $response->getStatusCode());

        $contentType = $response->getHeaders()["Content-Type"][0];
        $this->assertEquals("application/json; charset=utf-8", $contentType);
    }

    public function testGetRiverFromApi()
    {
        //journal publish
        $response = $this->riverApi->getPublications('');
        $this->assertIsArray($response);
        $this->assertEquals(10, count($response));


        //with slug
        $response = $this->riverApi->getPublications('google');
        $this->assertIsArray($response);
        $this->assertEquals(10, count($response));

    }
}
