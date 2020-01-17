<?php
/**
 * Created by PhpStorm.
 * User: marek
 * Date: 2020-01-16
 * Time: 17:58
 */

use JournalMedia\Sample\Service\LocalService;
use PHPUnit\Framework\TestCase;

/**
 * Class LocalServiceTest
 */
class LocalServiceTest extends TestCase
{

    public function testFetch()
    {
        $localService = new LocalService();
        $this->assertIsArray($localService->fetch());

        $localService->setTag('apple');
        $this->assertIsArray($localService->fetch());
    }

    public function testGetFilePath()
    {
        $localService = new LocalService();
        $this->assertSame('thejournal.json', $localService->getFilePath());

        $localService->setTag('apple');
        $this->assertSame('apple.json', $localService->getFilePath());
    }
}
