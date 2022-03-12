<?php

namespace App\Tests\Service;

use PHPUnit\Framework\TestCase;
use JournalMedia\Sample\ApiProject\Service\StaticContentProviderService;

class StaticContentProviderServiceTest extends TestCase
{
    private StaticContentProviderService $staticContentProviderService;

    protected function setUp() : void
    {
        $this->staticContentProviderService = new StaticContentProviderService();
        $_ENV['STATIC_CONTENT'] = '/../../resources/demo-responses/';
    }

    public function testGetDemoRiverNews() : void
    {
        $expected = file_get_contents(__DIR__ .  $_ENV['STATIC_CONTENT'] . 'thejournal.json');
        $demoMode = "true";
        $tag = null;
        $result =  $this->staticContentProviderService->getStaticContent($demoMode, $tag);
        $this->assertEquals(json_decode($expected, true), $result);
    }

    public function testGetDemoRiverTagGoogleNews() : void
    {
        $expected = file_get_contents(__DIR__ .  $_ENV['STATIC_CONTENT'] . 'google.json');
        $demoMode = "true";
        $tag = 'google';
        $result =  $this->staticContentProviderService->getStaticContent($demoMode, $tag);
        $this->assertEquals(json_decode($expected, true), $result);
    }
}