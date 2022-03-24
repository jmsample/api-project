<?php


use PHPUnit\Framework\TestCase;
use JournalMedia\Sample\ApiProject\Repositories\River\JSONRiverRepository;

class JSONRiverRepositoryTest extends TestCase
{
    private $JSONRepository;

    protected function setUp() : void{
        $this->JSONRepository = new JSONRiverRepository;
    }

    /**
     * @covers \JSONRiverRepository::getRiverByTag
     */
    public function testByTagShouldGetResults(){

        $result = $this->JSONRepository->getRiverByTag('google');
        $this->assertIsArray($result);
        $this->assertCount(10, $result);
        $this->assertEquals("EU ministers are trying to make Facebook and Google pay more tax", $result[0]->title);
    }

    /**
     * @covers \JSONRiverRepository::getRiver
     */
    public function testShouldGetResults(){

        $result = $this->JSONRepository->getRiver();
        $this->assertIsArray($result);
        $this->assertCount(6, $result);
        $this->assertEquals("Las Vegas shooter named as 64-year-old Stephen Paddock", $result[0]->title);
    }
}
