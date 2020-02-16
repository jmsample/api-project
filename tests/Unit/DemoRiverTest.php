<?php

namespace Unit;

use JournalMedia\Sample\Repository\DemoRiverRepository;
use PHPUnit\Framework\TestCase;

class DemoRiverTest extends TestCase
{
    public function setUp()
    {
        $path = 'resources/demo-responses/';
        $homeFile = 'thejournal.json';
        $this->riverDemo = new DemoRiverRepository($path, $homeFile);
    }

    public function testGetRiverDemo()
    {
        //journal publish static content
        $response = $this->riverDemo->getPublications();
        $this->assertIsArray($response);
        $this->assertEquals(6, count($response));
        $articleTitle = $response[0]['title'];
        $this->assertEquals("Las Vegas shooter named as 64-year-old Stephen Paddock", $articleTitle);

        //with slug static content
        $response = $this->riverDemo->getPublications('google');
        $this->assertIsArray($response);
        $this->assertEquals(10, count($response));
        $articleTitle = $response[0]['title'];
        $this->assertEquals("EU ministers are trying to make Facebook and Google pay more tax", $articleTitle);
    }
}
