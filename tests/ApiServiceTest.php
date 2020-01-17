<?php
/**
 * Created by PhpStorm.
 * User: marek
 * Date: 2020-01-16
 * Time: 17:59
 */

use JournalMedia\Sample\Service\ApiService;
use PHPUnit\Framework\TestCase;

/**
 * Class ApiServiceTest
 */
class ApiServiceTest extends TestCase
{

    public function testGetUrl()
    {
        $apiService = new ApiService();
        $this->assertSame('thejournal/', $apiService->getUrl());

        $apiService->setTag('apple');
        $this->assertSame('tag/apple', $apiService->getUrl());
    }

    public function testFetch()
    {
        $apiService = new ApiService();
        $this->assertIsArray($apiService->fetch());

        $apiService->setTag('apple');
        $this->assertIsArray($apiService->fetch());
    }
}
