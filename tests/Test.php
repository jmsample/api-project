<?php
declare(strict_types=1);

use PHPUnit\Framework\TestCase;
use Dotenv\Dotenv;
use JournalMedia\Sample\Application\DataProvider;
use JournalMedia\Sample\DataProviders\Api;
use JournalMedia\Sample\DataProviders\StaticData;
use GuzzleHttp\Client as HttpClient;


final class Test extends TestCase
{

    public function testGetProvider(): void
    {
        // case 1 test dataProvider in demo mode
        $this->isTestMode(true);
        $provider = (new DataProvider())::getProvider();
        $this->assertTrue($provider instanceof StaticData);

        // case 2 test with demo mode = false
        $this->isTestMode(false);
        $provider = (new DataProvider())::getProvider();
        $this->assertTrue($provider instanceof Api);
    }

    public function testDataProviders():void
    {
        // case 1 test API with correct env variables
        $this->isTestMode(false);
        $test = new Api();
        $i = count($test->getData());
        $this->assertGreaterThan(0, $i);

        // case 2 test API with broken env variables
        $this->isTestMode(true);
        $test = new Api();
        $i = count($test->getData());
        $this->assertEquals(0, $i);

        // case 3 test StaticData with correct env variables
        $this->isTestMode(false);
        $test = new StaticData();
        $i = count($test->getData());
        $this->assertGreaterThan(0, $i);

        // case 4 test StaticData with broken env variables
        $this->isTestMode(true);
        $test = new StaticData();
        $i = count($test->getData());
        $this->assertEquals(0, $i);
    }

    private function isTestMode($test){
        return $test ?
            (new Dotenv(__DIR__ . "/../", ".env.example"))->overload() :
            (new Dotenv(__DIR__ . "/../"))->overload();
    }
}

// command =  ./vendor/bin/phpunit --bootstrap vendor/autoload.php tests/
