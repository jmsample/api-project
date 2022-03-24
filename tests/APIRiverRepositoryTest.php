<?php


use PHPUnit\Framework\TestCase;
use JournalMedia\Sample\ApiProject\Repositories\River\APIRiverRepository;

class APIRiverRepositoryTest extends TestCase
{
    private $APIRepository;

    protected function setUp() : void{
        $this->APIRepository = new APIRiverRepository;
    }

    /**
     * @covers \APIRiverRepository::getRiverByTag
     */
    public function testByTagShouldGetResults(){

        $result = $this->APIRepository->getRiverByTag('google');
        $this->assertIsArray($result);
        $this->assertCount(10, $result);
        $this->assertIsString( $result[0]->title);
    }


    /**
     * @covers \APIRiverRepository::getRiver
     */
    public function testShouldGetResults(){

        $result = $this->APIRepository->getRiver();
        $this->assertIsArray($result);
        $this->assertCount(10, $result);
        $this->assertIsString($result[0]->title);
    }
}
