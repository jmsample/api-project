<?php
declare(strict_types=1);
use PHPUnit\Framework\TestCase;
use Dotenv\Dotenv;
use JournalMedia\Sample\Classes\DataProvider;
use JournalMedia\Sample\Classes\APIProvider;
use JournalMedia\Sample\Classes\StaticContentProvider;

class DataProviderTest extends TestCase
{
    private function loadEnviroment($demoMode) 
    {
        if ($demoMode === TRUE) {
            (new Dotenv(__DIR__ . "/../", ".env.example"))->overload();
        } else {
            (new Dotenv(__DIR__ . "/../", ".env"))->overload();
        }
    }

    public function testDemoDataType(): void
    {
        $this->loadEnviroment($demoMode=TRUE);
        $dataProvider = new DataProvider();
        $this->assertTrue($dataProvider->getProvider() instanceof StaticContentProvider);
    }
    
    public function testLiveDataType(): void
    {
        $this->loadEnviroment($demoMode=FALSE);
        $dataProvider = new DataProvider();
        $this->assertTrue($dataProvider->getProvider() instanceof APIProvider);
    }

    public function testDemoRiverData(): void
    {
        $this->loadEnviroment($demoMode=TRUE);
        $dataProvider = new DataProvider();
        $this->assertGreaterThan(0,count($dataProvider->getByPublication('thejournal')));
    }

    public function testLiveRiverData(): void
    {
        $this->loadEnviroment($demoMode=FALSE);
        $dataProvider = new DataProvider();
        $this->assertGreaterThan(0,count($dataProvider->getByPublication('thejournal')));
    }

    public function testInvalidPublicationRiverData(): void
    {
        $this->loadEnviroment($demoMode=TRUE);
        $dataProvider = new DataProvider();
        $this->assertEquals(0,count($dataProvider->getByPublication('x')));
    }

    public function testDemoTagRiverData(): void
    {
        $this->loadEnviroment($demoMode=TRUE);
        $dataProvider = new DataProvider();
        $this->assertGreaterThan(0,count($dataProvider->getByTag('google')));
    }

    public function testLiveTagRiverData(): void
    {
        $this->loadEnviroment($demoMode=FALSE);
        $dataProvider = new DataProvider();
        $this->assertGreaterThan(0,count($dataProvider->getByTag('google')));
    }
}